<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
use Illuminate\Support\Facades\Route;

// Home Page Route

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::controller(DemoController::class)->group(function () {
    Route::get('/', 'HomeMain')->name('home');

    Route::get('/about', 'Index')->name('about.page')->middleware('check');
    Route::get('/contact', 'ContactMethod')->name('contact.page');
});

//Admin All Route

Route::controller(AdminController::class)
    ->group(function () {
        // Logout Route
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        // Profile Route
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        // Edit Profile Route
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        // Store Profile Route
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');

        // Change Password Route
        Route::get('/change/password', 'ChangePassword')->name('change.password');
        // Update Password Route
        Route::post('/update/password', 'UpdatePassword')->name('update.password');

    });

// Home Slide All Route
Route::controller(HomeSliderController::class)->group(function () {
    // Home Slider Route
    Route::get('/home/slide', 'HomeSlider')->name('home.slide');

    // Update Slider Route
    Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
});

// About Page All Route
Route::controller(AboutController::class)->group(function () {
    // About Page Route
    Route::get('/about/page', 'AboutPage')->name('about.page');
    // Update About Route
    Route::post('/update/about', 'UpdateAbout')->name('update.about');
    // Home About Route
    Route::get('/about', 'HomeAbout')->name('home.about');

    Route::get('/about/multi/image', 'AboutMultiImage')->name('about.multi.image');
    Route::post('/store/multi/image', 'StoreMultiImage')->name('store.multi.image');

    Route::get('/all/multi/image', 'AllMultiImage')->name('all.multi.image');
    Route::get('/edit/multi/image/{id}', 'EditMultiImage')->name('edit.multi.image');

    Route::post('/update/multi/image', 'UpdateMultiImage')->name('update.multi.image');

    Route::get('/delete/multi/image/{id}', 'DeleteMultiImage')->name('delete.multi.image');
});

// Portfolio Section
Route::controller(PortfolioController::class)->group(function () {
    Route::get('/all/portfolio', 'AllPortfolio')->name('all.portfolio');

    Route::get('/add/portfolio', 'AddPortfolio')->name('add.portfolio');
    Route::post('/store/portfolio', 'StorePortfolio')->name('store.portfolio');

    Route::get('/edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio');
    Route::post('/update/portfolio', 'UpdatePortfolio')->name('update.portfolio');

    Route::get('/delete/portfolio/{id}', 'DeletePortfolio')->name('delete.portfolio');

    Route::get('/portfolio/details/{id}', 'PortfolioDetails')->name('portfolio.details');

    Route::get('/portfolio', 'HomePortfolio')->name('home.portfolio');

});

// Blog Category All Routes
Route::controller(BlogCategoryController::class)->group(function () {
    Route::get('/all/blog/category', 'AllBlogCategory')->name('all.blog.category');
    Route::get('/add/blog/category', 'AddBlogCategory')->name('add.blog.category');

    Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');

    Route::get('/edit/blog/category/{id}', 'EditBlogCategory')->name('edit.blog.category');

    Route::post('/update/blog/category/{id}', 'UpdateBlogCategory')->name('update.blog.category');

    Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');

});

// Blog All Route

Route::controller(BlogController::class)->group(function () {

    // Add Blog Route
    Route::get('/all/blog', 'AllBlog')->name('all.blog');
    Route::get('/add/blog', 'AddBlog')->name('add.blog');

    Route::post('/store/blog', 'StoreBlog')->name('store.blog');

    Route::get('/edit/blog/{id}', 'EditBlog')->name('edit.blog');

    Route::post('/update/blog', 'UpdateBlog')
        ->name('update.blog');

    Route::get('/delete/blog/{id}', 'DeleteBlog')->name('delete.blog');
    Route::get('/blog/details/{id}', 'BlogDetails')->name('blog.details');

    Route::get('/category/blog/{id}', 'CategoryBlog')->name('category.blog');

    Route::get('/blog', 'HomeBlog')->name('home.blog');

});

// Footer All Route
Route::controller(FooterController::class)->group(function () {

    Route::get('/footer/setup', 'FooterSetup')->name('footer.setup');

    Route::post('/update/footer', 'UpdateFooter')
        ->name('update.footer');

});

// Contacts All Route
Route::controller(ContactController::class)->group(function () {

    Route::get('/contact', 'Contact')->name('contact.me');

    Route::post('/store/message', 'StoreMessage')->name('store.message');

    Route::get('/contact/message', 'ContactMessage')->name('contact.message');

    Route::get('/delete/message/{id}', 'DeleteMessage')->name('delete.message');

});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';