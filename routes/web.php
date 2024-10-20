<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

// FRONTEND
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\Admin\ProfileController;

// BACKEND
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Other\LogController;
use App\Http\Controllers\Admin\Cms\TagController;

use App\Http\Controllers\Admin\Cms\ArticleController;

use App\Http\Controllers\Admin\Master\UserController;
use App\Http\Controllers\Admin\Other\BackupController;
use App\Http\Controllers\Admin\Setting\MenuController;
use App\Http\Controllers\Admin\Setting\RoleController;

use App\Http\Controllers\Admin\Master\CategoryController;
use App\Http\Controllers\Admin\Setting\CompanyController;
use App\Http\Controllers\Admin\Setting\SubMenuController;
use App\Http\Controllers\Admin\Setting\PermissionController;
use App\Http\Controllers\Admin\Master\CategoryTypeController;
use App\Http\Controllers\Admin\Setting\PrivacyPolicyController;
use App\Http\Controllers\Admin\Setting\TermsAndConditionController;

use App\Http\Controllers\PageController as FrontPageController;
use App\Http\Controllers\ArticleController as FrontArticleController;
use App\Http\Controllers\TagController as FrontTagController;

Route::post('image-upload', [ImageUploadController::class, 'storeImage'])->name('image.upload');

// HOMEPAGE
Route::get('', [HomeController::class, 'index'])->name('homepage');

// FRONT-END
// pages
Route::get('about', [FrontPageController::class, 'about'])->name('front.page.about');

// article
Route::get('article', [FrontArticleController::class, 'index'])->name('front.article');
Route::get('article/tag/{tag}', [FrontArticleController::class, 'tag'])->name('front.article.tags');
Route::get('article/search', [FrontArticleController::class, 'search'])->name('front.article.search');
Route::get('article/{slug}', [FrontArticleController::class, 'show'])->name('front.article.show');
Route::get('article/{slug}/related', [FrontArticleController::class, 'front.getRelatedArticles']);

// Route::middleware(['auth', 'verified', 'role:superadmin|administrator|employee'])->prefix('admin')->group(function () {
Route::middleware(['auth', 'verified', 'only_internal'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');
    Route::get('dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');
    
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('backend.profile.edit');
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('backend.profile.update');
    Route::patch('profile/destroy', [ProfileController::class, 'destroy'])->name('backend.profile.destroy');

    // MASTER
    Route::prefix('master')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('category_types', CategoryTypeController::class);
        Route::resource('users', UserController::class);
    });

    // CMS
    Route::prefix('cms')->group(function () {
        Route::resource('articles', ArticleController::class);
        Route::resource('tags', TagController::class);
    });

    // SETTING
    Route::prefix('setting')->group(function () {
        Route::get('company/edit', [CompanyController::class, 'edit'])->name('company.edit');
        Route::patch('company/update', [CompanyController::class, 'update'])->name('company.update');

        Route::get('privacy-policy/edit/', [PrivacyPolicyController::class, 'edit'])->name('backend.privacy-policy.edit');
        Route::patch('privacy-policy/update', [PrivacyPolicyController::class, 'update'])->name('backend.privacy-policy.update');

        Route::get('terms-and-conditions/edit/', [TermsAndConditionController::class, 'edit'])->name('backend.terms_and_conditions.edit');
        Route::patch('terms-and-conditions/update', [TermsAndConditionController::class, 'update'])->name('backend.terms_and_conditions.update');

        // for a specific guard:
        Route::group(['middleware' => ['role:superadmin']], function () {
            Route::resource('menus', MenuController::class);
            Route::resource('sub_menus', SubMenuController::class);
            Route::resource('permissions', PermissionController::class);
            Route::resource('roles', RoleController::class);
        });
    });

    // OTHER
    Route::middleware(['role:superadmin'])->prefix('other')->group(function () {
        // log
        Route::get('logs', [LogController::class, 'index'])->name('logs.index');

        // Menampilkan halaman backup
        Route::get('backup_databases', [BackupController::class, 'index'])->name('backup.index');

        // Proses backup database
        Route::post('backup_databases/run', [BackupController::class, 'runBackup'])->name('backup.run');

        // Hapus satu file backup
        Route::delete('backup_databases/delete/{filename}', [BackupController::class, 'deleteBackup'])->name('backup.delete');

        // Hapus semua backup
        Route::delete('backup_databases/delete_all', [BackupController::class, 'deleteAllBackups'])->name('backup.deleteAll');

        // Download file backup
        Route::get('backup/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
    });
});

Route::prefix('region')->group(function () {
    Route::get('getCity', [RegionController::class, 'getCity'])->name('region.getCity');
    Route::get('getDistrict', [RegionController::class, 'getDistrict'])->name('region.getDistrict');
    Route::get('getVillage', [RegionController::class, 'getVillage'])->name('region.getVillage');
});

require __DIR__ . '/auth.php';
