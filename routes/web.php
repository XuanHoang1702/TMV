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
use App\Http\Controllers\FrontendServiceController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\ProcessController;
use App\Models\News;
use App\Models\PageContent;
use App\Http\Controllers\GoogleMapsController;
use App\Http\Controllers\Admin\EmailNotificationController;


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

// Language Route
Route::get('lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return redirect()->back();
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

    return view('home', compact('banners', 'categories', 'services', 'certificates', 'tabs', 'newsByCategory'));
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
    return view('pricing', compact('pricingBanner'));
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


Route::get('/tin-tuc/{slug}', function ($slug) {
$news = \App\Models\News::with('category')
        ->where('slug', $slug)
        ->where('is_active', true)
        ->whereNotNull('published_at') // bài chưa xuất bản sẽ trả 404
        ->firstOrFail();

    $newsBanner = PageContent::where('page', 'news_banner')->first();
     $relatedNews = \App\Models\News::where('category_id', $news->category_id)
        ->where('id', '!=', $news->id)
        ->where('is_active', true)
        ->whereNotNull('published_at') // chỉ lấy bài đã xuất bản
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();

    return view('news.show_detail', compact('news', 'newsBanner', 'relatedNews'));
})->name('news.detail');

Route::get('/tin-tuc/danh-muc/{category}', function ($category) {
   $categories = \App\Models\Category::where('type', 'news')
        ->whereIn('slug', ['chuyen-mon', 'dao-tao', 'tu-thien', 'bao-chi-truyen-thong'])
        ->get()
        ->keyBy('slug');

    $newsCategories = \App\Models\Category::where('type', 'news')->where('is_active', true)->orderBy('order')->get();

    $newsByCategory = [];
    foreach ($categories as $slug => $cat) {
        $newsByCategory[$slug] = \App\Models\News::where('category_id', $cat->id)
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();
    }
    return view('news.category', compact('category', 'newsCategories', 'newsByCategory'));
})->name('news.category');
Route::get('/lien-he', function () {
    $hospitalImages = \App\Models\HopitalImage::latest()->take(5)->get();
    $information = \App\Models\Information::first();
    $contactBanner = \App\Models\PageContent::where('page', 'contact')->first();
    return view('contact', compact('hospitalImages', 'information', 'contactBanner'));
})->name('contact');

// Email Notification
Route::resource('email-notification', EmailNotificationController::class)->only(['store']);


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
    // Xuất bản tin tức
    Route::post('news/{news}/publish', [NewsController::class, 'publish'])->name('news.publish');

    // Gỡ xuất bản tin tức
    Route::post('news/{news}/unpublish', [NewsController::class, 'unpublish'])->name('news.unpublish');

    Route::delete('news/{news}/remove-image', [NewsController::class, 'removeImage'])->name('news.removeImage');


    // Appointments Management
    Route::resource('appointments', AppointmentController::class);
    Route::post('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
    Route::get('appointments-calendar', [AppointmentController::class, 'calendar'])->name('appointments.calendar');
    Route::get('appointments-export', [AppointmentController::class, 'export'])->name('appointments.export');

    // Contacts Management
    // Route::resource('contacts', ContactController::class)->except(['create', 'store', 'edit', 'update']);
    // Route::post('contacts/{contact}/reply', [ContactController::class, 'reply'])->name('contacts.reply');
    // Route::post('contacts/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
    // Route::post('contacts/bulk-mark-read', [ContactController::class, 'bulkMarkAsRead'])->name('contacts.bulk-mark-read');

    // Media Management


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

    // Advertisement
    Route::resource('advertisement', AdvertisementController::class);

    //Process
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
    Route::get('test-map', function () {
    return view('admin.informations.test-map');
})->name('admin.informations.test-map');


// Debug route - chỉ dùng để test
Route::get('/admin/debug-geocode/{lat}/{lng}', function($lat, $lng) {
    $controller = new \App\Http\Controllers\Admin\InformationController();
    $address = $controller->getRealAddressFromCoordinates($lat, $lng);

    return response()->json([
        'coordinates' => "({$lat}, {$lng})",
        'address' => $address,
        'cache_key' => "real_address_{$lat}_{$lng}",
        'timestamp' => now()->toDateTimeString()
    ]);
})->name('admin.debug.geocode');
});

require __DIR__.'/auth.php';
