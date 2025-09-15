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
use App\Http\Controllers\Admin\BannerController;
use App\Models\Banner;
use App\Models\Category;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\HopitalImageController;


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
// Home route
Route::get('/', function () {
    $currentPage = Route::currentRouteName() ?: 'home';
    $banners = \App\Models\Banner::where('section', '1')
        ->where('page', $currentPage)
        ->where('is_active', true)
        ->orderBy('order')
        ->get();
    $categories = \App\Models\Category::where('type', 'services')
        ->where('is_active', true)
        ->orderBy('order')
        ->get();
    $services = \App\Models\Service::where('is_active', true)
        ->whereNull('parent_id')
        ->with(['children', 'category'])
        ->orderBy('sort_order')
        ->get();
    $certificates = \App\Models\Certificate::orderBy('order')
        ->get();

    return view('home', compact('banners', 'categories', 'services', 'certificates'));
})->name('home');

// Sitemap route
use App\Http\Controllers\SitemapController;
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');

// RSS Feed route
use App\Http\Controllers\RssController;
Route::get('/feed.xml', [RssController::class, 'index'])->name('rss.feed');

// Trang /dich-vu
Route::get('/dich-vu', function () {
    return view('services.index');
})->name('services.index');


Route::get('/dich-vu/{slug}', function ($slug) {
    $service = \App\Models\Service::where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();
    return view('services.show', compact('service'));
})->name('services.detail');

Route::get('/ve-dr-dat', function () {return view('about');})->name('about');

Route::get('/bao-gia', function () {return view('pricing');})->name('pricing');
Route::get('/tin-tuc', function () {return view('news.index');})->name('news.index');
Route::get('/tin-tuc/{slug}', function ($slug) {return view('news.show', compact('slug'));})->name('news.detail');
Route::get('/tin-tuc/danh-muc/{category}', function ($category) {return view('news.category', compact('category'));})->name('news.category');
Route::get('/lien-he', function () {
    $hospitalImages = \App\Models\HopitalImage::latest()->take(5)->get();
    $information = \App\Models\Information::first();
    return view('contact', compact('hospitalImages', 'information'));
})->name('contact');

Route::post('/dat-lich', [\App\Http\Controllers\Admin\AppointmentController::class, 'storeFrontend'])->name('appointments.store');

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
    Route::get('admin/news/{news}', [NewsController::class, 'show'])->name('admin.news.show');

    // Appointments Management
    Route::resource('appointments', AppointmentController::class);
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
    Route::post('menus/{menu}/toggle-status', [MenuController::class, 'toggleStatus'])->name('menus.toggle-status');
    Route::get('menu/{route}', [MenuController::class, 'show'])->where('route', '.*');

    // Banners Management
    Route::resource('banners', BannerController::class);

    // Home Sections Management
    Route::resource('home_sections', \App\Http\Controllers\Admin\HomeSectionController::class);

    // Information
    Route::resource('informations', InformationController::class);

    // Certificates Management
    Route::resource('certificates', \App\Http\Controllers\Admin\CertificateController::class);
    //Site Information
    Route::resource('siteInfo', SiteInfoController::class);
    Route::delete('siteInfo/delete-header-logo/{id}', [SiteInfoController::class, 'deleteHeaderLogo'])->name('siteInfo.deleteHeaderLogo');
    Route::delete('siteInfo/delete-footer-logo/{id}', [SiteInfoController::class, 'deleteFooterLogo'])->name('siteInfo.deleteFooterLogo');
    Route::delete('siteInfo/delete-slogan/{id}', [SiteInfoController::class, 'deleteSlogan'])->name('siteInfo.deleteSlogan');

    //Page Content
    Route::resource('page_contents', PageContentController::class);

    // Hopital Image
    Route::resource('hospital_images', HopitalImageController::class);


});

require __DIR__.'/auth.php';
