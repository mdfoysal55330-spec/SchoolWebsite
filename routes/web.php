<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CustomLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SchoolInfoController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\UserAccessController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/page/{slug}', [PublicPageController::class, 'show'])
    ->name('public.page');

Route::get('/language/{locale}', function ($locale) {

    abort_unless(
        in_array($locale, ['bn', 'en']),
        404
    );

    session(['locale' => $locale]);

    return redirect()->back();

})->name('language.switch');

/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // School Information
    Route::middleware('admin.permission:school-info')->group(function () {
        Route::get('/admin/school-info', [SchoolInfoController::class, 'edit'])
            ->name('admin.school-info.edit');

        Route::put('/admin/school-info', [SchoolInfoController::class, 'update'])
            ->name('admin.school-info.update');
    });

    // Banners
    Route::middleware('admin.permission:banners')->group(function () {
        Route::get('/admin/banners', [BannerController::class, 'index'])
            ->name('admin.banners.index');

        Route::post('/admin/banners', [BannerController::class, 'store'])
            ->name('admin.banners.store');

        Route::get('/admin/banners/{banner}/edit', [BannerController::class, 'edit'])
            ->name('admin.banners.edit');

        Route::put('/admin/banners/{banner}', [BannerController::class, 'update'])
            ->name('admin.banners.update');

        Route::delete('/admin/banners/{banner}', [BannerController::class, 'destroy'])
            ->name('admin.banners.destroy');
    });

    // Notices
    Route::middleware('admin.permission:notices')->group(function () {
        Route::get('/admin/notices', [NoticeController::class, 'index'])
            ->name('admin.notices.index');

        Route::post('/admin/notices', [NoticeController::class, 'store'])
            ->name('admin.notices.store');

        Route::get('/admin/notices/{notice}/edit', [NoticeController::class, 'edit'])
            ->name('admin.notices.edit');

        Route::put('/admin/notices/{notice}', [NoticeController::class, 'update'])
            ->name('admin.notices.update');

        Route::delete('/admin/notices/{notice}', [NoticeController::class, 'destroy'])
            ->name('admin.notices.destroy');
    });

    // Custom Links
    Route::middleware('admin.permission:custom-links')->group(function () {
        Route::get('/admin/custom-links', [CustomLinkController::class, 'index'])
            ->name('admin.custom-links.index');

        Route::post('/admin/custom-links', [CustomLinkController::class, 'store'])
            ->name('admin.custom-links.store');

        Route::get('/admin/custom-links/{customLink}/edit', [CustomLinkController::class, 'edit'])
            ->name('admin.custom-links.edit');

        Route::put('/admin/custom-links/{customLink}', [CustomLinkController::class, 'update'])
            ->name('admin.custom-links.update');

        Route::delete('/admin/custom-links/{customLink}', [CustomLinkController::class, 'destroy'])
            ->name('admin.custom-links.destroy');
    });

    // Teachers
    Route::middleware('admin.permission:teachers')->group(function () {
        Route::get('/admin/teachers', [TeacherController::class, 'index'])
            ->name('admin.teachers.index');

        Route::post('/admin/teachers', [TeacherController::class, 'store'])
            ->name('admin.teachers.store');

        Route::get('/admin/teachers/{teacher}/edit', [TeacherController::class, 'edit'])
            ->name('admin.teachers.edit');

        Route::put('/admin/teachers/{teacher}', [TeacherController::class, 'update'])
            ->name('admin.teachers.update');

        Route::delete('/admin/teachers/{teacher}', [TeacherController::class, 'destroy'])
            ->name('admin.teachers.destroy');
    });

    // Gallery
    Route::middleware('admin.permission:gallery')->group(function () {
        Route::get('/admin/gallery', [GalleryController::class, 'index'])
            ->name('admin.gallery.index');

        Route::post('/admin/gallery', [GalleryController::class, 'store'])
            ->name('admin.gallery.store');

        Route::get('/admin/gallery/{gallery}/edit', [GalleryController::class, 'edit'])
            ->name('admin.gallery.edit');

        Route::put('/admin/gallery/{gallery}', [GalleryController::class, 'update'])
            ->name('admin.gallery.update');

        Route::delete('/admin/gallery/{gallery}', [GalleryController::class, 'destroy'])
            ->name('admin.gallery.destroy');
    });

    // News
    Route::middleware('admin.permission:news')->group(function () {
        Route::get('/admin/news', [NewsController::class, 'index'])
            ->name('admin.news.index');

        Route::post('/admin/news', [NewsController::class, 'store'])
            ->name('admin.news.store');

        Route::get('/admin/news/{news}/edit', [NewsController::class, 'edit'])
            ->name('admin.news.edit');

        Route::put('/admin/news/{news}', [NewsController::class, 'update'])
            ->name('admin.news.update');

        Route::delete('/admin/news/{news}', [NewsController::class, 'destroy'])
            ->name('admin.news.destroy');
    });

    // Pages
    Route::middleware('admin.permission:pages')->group(function () {
        Route::get('/admin/pages', [PageController::class, 'index'])
            ->name('admin.pages.index');

        Route::post('/admin/pages', [PageController::class, 'store'])
            ->name('admin.pages.store');

        Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit'])
            ->name('admin.pages.edit');

        Route::put('/admin/pages/{page}', [PageController::class, 'update'])
            ->name('admin.pages.update');

        Route::delete('/admin/pages/{page}', [PageController::class, 'destroy'])
            ->name('admin.pages.destroy');
    });

    // User Access
    Route::middleware('admin.permission:users')->group(function () {
        Route::get('/admin/users', [UserAccessController::class, 'index'])
            ->name('admin.users.index');

        Route::post('/admin/users', [UserAccessController::class, 'store'])
            ->name('admin.users.store');

        Route::get('/admin/users/{user}/edit', [UserAccessController::class, 'edit'])
            ->name('admin.users.edit');

        Route::put('/admin/users/{user}', [UserAccessController::class, 'update'])
            ->name('admin.users.update');

        Route::delete('/admin/users/{user}', [UserAccessController::class, 'destroy'])
            ->name('admin.users.destroy');
    });

});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::middleware('admin.permission:settings')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');
    });

});

require __DIR__.'/auth.php';
