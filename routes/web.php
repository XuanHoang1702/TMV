<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Facades\Volt;


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
use App\Http\Controllers\FrontendServiceController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\ProcessController;
use App\Models\News;
use App\Models\PageContent;
use App\Http\Controllers\GoogleMapsController;
use App\Http\Controllers\Admin\EmailNotificationController;
use App\Http\Controllers\Admin\PricingFooterController;
use App\Http\Controllers\SearchController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


//Frontend Routes
// Home route
Route::get('/api/zalo-contact', function () {
    try {
        $zalo = \App\Models\ZaloSetting::getCurrent();

        if (!$zalo) {
            // Fallback nếu chưa có data
            return response()->json([
                'zalo' => [
                    'contact' => '0123456789',
                    'type' => 'phone',
                    'icon' => 'fas fa-comment',
                    'url' => 'https://zalo.me/0123456789',
                ],
                'messenger' => [
                    'contact' => 'drdatclinic',
                    'type' => 'facebook',
                    'icon' => 'fab fa-facebook-messenger',
                    'url' => 'https://m.me/drdatclinic',
                ],
                'call' => [
                    'contact' => '0123456789',
                    'type' => 'phone',
                    'icon' => 'fas fa-phone',
                    'url' => 'tel:0123456789',
                ]
            ]);
        }

        return response()->json([
            'zalo' => [
                'contact' => $zalo->zalo_contact,
                'type' => $zalo->zalo_type ?? 'phone',
                'icon' => $zalo->zalo_icon ?? 'fas fa-comment',
                'url' => $zalo->zalo_url,
            ],
            'messenger' => [
                'contact' => $zalo->messenger_contact,
                'type' => $zalo->messenger_type ?? 'facebook',
                'icon' => $zalo->messenger_icon ?? 'fab fa-facebook-messenger',
                'url' => $zalo->messenger_url,
            ],
            'call' => [
                'contact' => $zalo->call_contact,
                'type' => $zalo->call_type ?? 'phone',
                'icon' => $zalo->call_icon ?? 'fas fa-phone',
                'url' => $zalo->call_url,
            ]
        ]);
    } catch (\Exception $e) {
        // Fallback nếu có lỗi
        return response()->json([
            'zalo' => [
                'contact' => '0123456789',
                'type' => 'phone',
                'icon' => 'fas fa-comment',
                'url' => 'https://zalo.me/0123456789',
            ],
            'messenger' => [
                'contact' => 'drdatclinic',
                'type' => 'facebook',
                'icon' => 'fab fa-facebook-messenger',
                'url' => 'https://m.me/drdatclinic',
            ],
            'call' => [
                'contact' => '0123456789',
                'type' => 'phone',
                'icon' => 'fas fa-phone',
                'url' => 'tel:0123456789',
            ]
        ], 200); // Trả về 200 để frontend không crash
    }
});
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

    $tabs = \App\Models\Category::where('type', 'news')
        ->where('is_active', true)
        ->orderBy('order')
        ->get();

    $newsByCategory = [];
    foreach ($tabs as $category) {
        $newsByCategory[$category->slug] = \App\Models\News::where('category_id', $category->id)
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();
    }
 $newsMenuLabel = \App\Models\Menu::where('route', 'news.index')
    ->value('label');


    // Truyền ra view
    return view('home', compact(
        'banners',
        'categories',
        'services',
        'certificates',
        'tabs',
        'newsByCategory',
        'newsMenuLabel'
    ));
})->name('home');

// Sitemap route
use App\Http\Controllers\SitemapController;
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');

// RSS Feed route
use App\Http\Controllers\RssController;
Route::get('/feed.xml', [RssController::class, 'index'])->name('rss.feed');

// Trang /dich-vu
Route::get('/dich-vu', [FrontendServiceController::class, 'index'])->name('services.index');
Route::get('/service-detail/{slug}', [FrontendServiceController::class, 'show'])->name('services.detail');

Route::get('/abouts', [FrontendServiceController::class, 'about'])->name('abouts');

Route::get('/bao-gia', function () {
        $pricingBanner = \App\Models\PageContent::where('page', 'pricing_banner')->first();
    $pricingFooterItems = \App\Models\PricingFooter::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
    return view('pricing', compact('pricingBanner', 'pricingFooterItems'));


})->name('pricing');
Route::get('/tin-tuc', function (){

    $newsBanner = \App\Models\PageContent::where('page', 'news_banner')->first();
    $newsCategories = \App\Models\Category::where('type', 'news')->where('is_active', true)->orderBy('order')->get();
     $newsList = News::where('is_active', true)
        ->whereNotNull('published_at')  // chỉ lấy bài đã xuất bản
        ->orderBy('published_at', 'desc')
        ->paginate(12);
    return view('news.index', compact('newsBanner', 'newsCategories', 'newsList'));
})->name('news.index');

// News category route
Route::get('/tin-tuc/{categorySlug}', [\App\Http\Controllers\NewsController::class, 'category'])->name('news.category');

// Support both URL formats for backward compatibility
Route::get('/tin-tuc/{slug}', function ($slug) {
    $news = News::where('slug', $slug)
        ->where('is_active', true)
        ->whereNotNull('published_at')
        ->firstOrFail();

    return redirect()->route('news.detail', [$news->category->slug, $news->slug]);
})->name('news.detail.old');

// Use NewsController for news detail to get proper related news functionality
Route::get('/tin-tuc/{category}/{slug}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.detail');

Route::get('/lien-he', function () {
    $hospitalImages = \App\Models\HopitalImage::latest()->take(5)->get();
    $information = \App\Models\Information::first();
    $contactBanner = \App\Models\PageContent::where('page', 'contact_banner')->first();
    return view('contact', compact('hospitalImages', 'information', 'contactBanner'));
})->name('contact');

// Email Notification
Route::resource('email-notification', EmailNotificationController::class)->only(['store']);

// Search Routes
Route::get('/tim-kiem', [SearchController::class, 'index'])->name('search.index');
Route::post('/tim-kiem', [SearchController::class, 'search'])->name('search.results');

Route::post('/dat-lich', [\App\Http\Controllers\Admin\AppointmentController::class, 'storeFrontend'])->name('appointments.store');

// Admin Auth Routes
// Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
// Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
// Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


use App\Http\Controllers\Auth\VerifyEmailController;
// Guest routes - Sử dụng Livewire components trực tiếp
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
    Route::post('/login', \App\Livewire\Auth\Login::class)->name('login');




});


// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Services Management
    Route::resource('services', ServiceController::class);
    Route::post('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    Route::get('services/{service}/details', [ServiceController::class, 'manageDetails'])->name('services.details');
    Route::post('services/{service}/details', [ServiceController::class, 'storeDetail'])->name('services.details.store');
    Route::delete('services/details/{detail}', [ServiceController::class, 'destroyDetail'])->name('services.details.destroy');

    // News Management
    Route::get('news', [\App\Http\Controllers\Admin\NewsController::class, 'index'])->name('news.index');
    Route::get('news/create', [\App\Http\Controllers\Admin\NewsController::class, 'create'])->name('news.create');
    Route::post('news', [\App\Http\Controllers\Admin\NewsController::class, 'store'])->name('news.store');
    Route::get('news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'show'])->name('news.show');
    Route::get('news/{news}/edit', [\App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('news.edit');
    Route::put('news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'update'])->name('news.update');
    Route::delete('news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('news.destroy');
    Route::post('news/{news}/publish', [\App\Http\Controllers\Admin\NewsController::class, 'publish'])->name('news.publish');
    Route::post('news/{news}/unpublish', [\App\Http\Controllers\Admin\NewsController::class, 'unpublish'])->name('news.unpublish');
    Route::post('news/upload-image', [\App\Http\Controllers\Admin\NewsController::class, 'uploadImage'])->name('news.upload-image');
    Route::delete('news/{news}/remove-image', [\App\Http\Controllers\Admin\NewsController::class, 'removeImage'])->name('news.removeImage');

    // Appointments Management
    Route::resource('appointments', AppointmentController::class);
    Route::post('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
    Route::get('appointments-calendar', [AppointmentController::class, 'calendar'])->name('appointments.calendar');
    Route::get('appointments-export', [AppointmentController::class, 'export'])->name('appointments.export');

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

    // Menu
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

    // Site Information
    Route::resource('siteInfo', SiteInfoController::class);
    Route::delete('siteInfo/delete-header-logo/{id}', [SiteInfoController::class, 'deleteHeaderLogo'])->name('siteInfo.deleteHeaderLogo');
    Route::delete('siteInfo/delete-footer-logo/{id}', [SiteInfoController::class, 'deleteFooterLogo'])->name('siteInfo.deleteFooterLogo');
    Route::delete('siteInfo/delete-slogan/{id}', [SiteInfoController::class, 'deleteSlogan'])->name('siteInfo.deleteSlogan');

    // Page Content
    Route::resource('page_contents', PageContentController::class);

    // Hospital Image
    Route::resource('hospital_images', HopitalImageController::class);

    // Advertisement
    Route::resource('advertisement', AdvertisementController::class);

    // Process
    Route::resource('process', ProcessController::class);
    Route::get('reason', [ProcessController::class, 'reasonIndex'])->name('reason.index');
    Route::get('reason/create', [ProcessController::class, 'reasonCreate'])->name('reason.create');
    Route::post('reason', [ProcessController::class, 'reasonStore'])->name('reason.store');
    Route::get('reason/{process}', [ProcessController::class, 'reasonShow'])->name('reason.show');
    Route::get('reason/{process}/edit', [ProcessController::class, 'reasonEdit'])->name('reason.edit');
    Route::put('reason/{process}', [ProcessController::class, 'reasonUpdate'])->name('reason.update');
    Route::delete('reason/{process}', [ProcessController::class, 'reasonDestroy'])->name('reason.destroy');

    // About Management
    Route::resource('abouts', \App\Http\Controllers\Admin\AboutController::class);
    Route::resource('about-us', \App\Http\Controllers\Admin\AboutUsController::class);

    // Zalo Settings
    Route::get('zalo', [\App\Http\Controllers\Admin\ZaloController::class, 'index'])->name('zalo.index');
    Route::post('zalo', [\App\Http\Controllers\Admin\ZaloController::class, 'store'])->name('zalo.store');
    Route::put('zalo', [\App\Http\Controllers\Admin\ZaloController::class, 'update'])->name('zalo.update');

    // Pricing Footer
    Route::resource('pricing_footer', PricingFooterController::class);
    Route::post('pricing_footer/{pricingFooter}/toggle-status', [PricingFooterController::class, 'toggleStatus'])->name('pricing_footer.toggle-status');
});

require __DIR__.'/auth.php';
