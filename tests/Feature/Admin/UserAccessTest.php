<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('existing admin accounts retain full access until permissions are assigned', function () {
    $user = User::factory()->create();

    expect($user->hasAdminPermission('users'))->toBeTrue();

    $this->actingAs($user)
        ->get(route('admin.users.index'))
        ->assertOk();

    expect($user->permissions)->toBeNull()
        ->and($user->hasAdminPermission('users'))->toBeTrue()
        ->and($user->hasAdminPermission('pages'))->toBeTrue();
});

test('users can only access admin modules granted to their account', function () {
    $user = User::factory()->create();
    $user->permissions = ['notices'];
    $user->save();

    $this->actingAs($user)
        ->get(route('admin.notices.index'))
        ->assertOk();

    $this->get(route('admin.banners.index'))->assertForbidden();
    $this->get(route('admin.users.index'))->assertForbidden();
});

test('dashboard only shows cards the signed-in user can access', function () {
    $user = User::factory()->create();
    $user->permissions = ['notices'];
    $user->save();

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee('Notices')
        ->assertDontSee('Banners')
        ->assertDontSee('User Access');
});

test('admin can create a user with selected module permissions', function () {
    $admin = User::factory()->create();

    $response = $this->actingAs($admin)->post(route('admin.users.store'), [
        'name' => 'School Editor',
        'email' => 'editor@example.com',
        'password' => 'secure-password',
        'password_confirmation' => 'secure-password',
        'permissions' => ['notices', 'news'],
    ]);

    $response->assertRedirect(route('admin.users.index'));

    $user = User::query()->where('email', 'editor@example.com')->firstOrFail();

    expect($user->permissions)->toBe(['notices', 'news'])
        ->and($user->hasVerifiedEmail())->toBeTrue()
        ->and(Hash::check('secure-password', $user->password))->toBeTrue();
});

test('admin can update an existing users module permissions', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create();
    $user->permissions = ['notices'];
    $user->save();

    $response = $this->actingAs($admin)->put(route('admin.users.update', $user), [
        'name' => $user->name,
        'email' => $user->email,
        'permissions' => ['pages', 'gallery'],
    ]);

    $response->assertRedirect(route('admin.users.index'));
    expect($user->fresh()->permissions)->toBe(['pages', 'gallery']);
});

test('admin cannot create a user with an unknown permission', function () {
    $admin = User::factory()->create();

    $response = $this->actingAs($admin)->from(route('admin.users.index'))->post(route('admin.users.store'), [
        'name' => 'School Editor',
        'email' => 'editor@example.com',
        'password' => 'secure-password',
        'password_confirmation' => 'secure-password',
        'permissions' => ['make-me-admin'],
    ]);

    $response->assertSessionHasErrors('permissions.0');
    $this->assertDatabaseMissing('users', ['email' => 'editor@example.com']);
});

test('the last user access manager cannot remove their own access', function () {
    $admin = User::factory()->create();

    $response = $this->actingAs($admin)->from(route('admin.users.edit', $admin))->put(route('admin.users.update', $admin), [
        'name' => $admin->name,
        'email' => $admin->email,
        'permissions' => ['settings'],
    ]);

    $response->assertSessionHasErrors('permissions');
    expect($admin->fresh()->permissions)->toBeNull();
});

test('the last user access manager cannot delete their own account from profile settings', function () {
    $admin = User::factory()->create();

    $response = $this->actingAs($admin)->from('/profile')->delete('/profile', [
        'password' => 'password',
    ]);

    $response->assertSessionHasErrorsIn('userDeletion', 'password');
    $this->assertModelExists($admin);
});
