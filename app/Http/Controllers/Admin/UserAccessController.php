<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserAccessController extends Controller
{
    public function index(): View
    {
        return view('admin.users', [
            'users' => User::query()
                ->select(['id', 'name', 'email', 'role', 'permissions', 'created_at'])
                ->orderBy('name')
                ->paginate(15),
            'permissions' => config('admin.permissions'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'permissions' => ['required', 'array', 'min:1'],
            'permissions.*' => ['required', 'string', Rule::in(array_keys(config('admin.permissions')))],
        ]);

        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->email_verified_at = now();
        $user->permissions = array_values(array_unique($validated['permissions']));
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        return view('admin.user-edit', [
            'user' => $user,
            'permissions' => config('admin.permissions'),
            'selectedPermissions' => $user->permissions ?? array_keys(config('admin.permissions')),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'permissions' => ['required', 'array', 'min:1'],
            'permissions.*' => ['required', 'string', Rule::in(array_keys(config('admin.permissions')))],
        ]);

        $selectedPermissions = array_values(array_unique($validated['permissions']));

        if (
            $user->hasAdminPermission('users')
            && ! in_array('users', $selectedPermissions, true)
            && ! $this->hasOtherUserManager($user)
        ) {
            return back()
                ->withErrors(['permissions' => 'At least one user must retain User Access permission.'])
                ->withInput();
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->permissions = $selectedPermissions;

        if (! empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User access updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->is(auth()->user())) {
            return back()->withErrors(['user' => 'You cannot delete your own account here.']);
        }

        if ($user->hasAdminPermission('users') && ! $this->hasOtherUserManager($user)) {
            return back()->withErrors(['user' => 'At least one user must retain User Access permission.']);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    private function hasOtherUserManager(User $user): bool
    {
        return User::query()
            ->where('id', '!=', $user->id)
            ->get(['id', 'role', 'permissions'])
            ->contains(fn (User $candidate): bool => $candidate->hasAdminPermission('users'));
    }
}
