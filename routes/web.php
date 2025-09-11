<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
//Frontend Routes
Route::get('/', function () {return view('home');})->name('home');
Route::get('/ve-dr-dat', function () {return view('about');})->name('about');
Route::get('/dich-vu', function () {return view('services.index');})->name('services.index');
Route::get('/dich-vu/{slug}', function ($slug) {return view('services.show', compact('slug'));})->name('services.detail');
Route::get('/bao-gia', function () {return view('pricing');})->name('pricing');
Route::get('/tin-tuc', function () {return view('news.index');})->name('news.index');
Route::get('/tin-tuc/{slug}', function ($slug) {return view('news.show', compact('slug'));})->name('news.detail');
Route::get('/tin-tuc/danh-muc/{category}', function ($category) {return view('news.category', compact('category'));})->name('news.category');
Route::get('/lien-he', function () {return view('contact');})->name('contact');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Services Management
    Route::resource('services', ServiceController::class);
    Route::post('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    Route::get('services/{service}/details', [ServiceController::class, 'manageDetails'])->name('services.details');
    Route::post('services/{service}/details', [ServiceController::class, 'storeDetail'])->name('services.details.store');
    Route::delete('services/details/{detail}', [ServiceController::class, 'destroyDetail'])->name('services.details.destroy');

    // News Management
    Route::resource('news', NewsController::class);
    Route::post('news/{news}/publish', [NewsController::class, 'publish'])->name('news.publish');
    Route::post('news/{news}/unpublish', [NewsController::class, 'unpublish'])->name('news.unpublish');

    // Appointments Management
    Route::resource('appointments', AppointmentController::class)->except(['create', 'store']);
    Route::post('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
    Route::get('appointments-calendar', [AppointmentController::class, 'calendar'])->name('appointments.calendar');
    Route::get('appointments-export', [AppointmentController::class, 'export'])->name('appointments.export');

    // Contacts Management
    Route::resource('contacts', ContactController::class)->except(['create', 'store', 'edit', 'update']);
    Route::post('contacts/{contact}/reply', [ContactController::class, 'reply'])->name('contacts.reply');
    Route::post('contacts/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::post('contacts/bulk-mark-read', [ContactController::class, 'bulkMarkAsRead'])->name('contacts.bulk-mark-read');

    // Media Management
    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::delete('media/delete', [MediaController::class, 'delete'])->name('media.delete');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Users Management
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Categories Management
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
    Route::post('categories/update-order', [CategoryController::class, 'updateOrder'])->name('categories.update-order');

    // Profile
    Route::get('profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');


    //Menu
    Route::resource('menus', MenuController::class);
    Route::get('menu/{menu}', [MenuController::class, 'show'])->where('route', '.*');
    Route::post('menus/{menu}/toggle-status', [MenuController::class, 'toggleStatus'])->name('menus.toggle-status');

});

require __DIR__.'/auth.php';
