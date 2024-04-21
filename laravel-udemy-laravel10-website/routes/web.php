<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin All Controller
    Route::controller(AdminController::class)->group( function () {
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');

        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');
    });

    // Home Slide All Route
    Route::controller(HomeSliderController::class)->group( function () {
        Route::get('/home/slide', 'HomeSlider')->name('home.slide');
        Route::post('/update/slider/{id}', 'UpdateSlider')->name('update.slider');
    });

    // About Page All Route
    Route::controller(AboutController::class)->group( function () {
        Route::get('/about/page', 'AboutPage')->name('about.page');
        Route::post('/update/about', 'UpdateAbout')->name('update.about');
        Route::get('/about', 'HomeAbout')->name('home.about');

        Route::get('/about/multi/image', 'AboutMultiImage')->name('about.multi.image');
        Route::post('/store/multi/image', 'StoreMultiImage')->name('store.multi.image');
        Route::get('/all/multi/image', 'AllMultiImage')->name('all.multi.image');
        Route::get('/edit/multi/image/{id}', 'EditMultiImage')->name('edit.multi.image');
        Route::put('/update/multi/image/', 'UpdateMultiImage')->name('update.multi.image');
        Route::delete('/delete/multi/image/{id}', 'DeleteMultiImage')->name('delete.multi.image');
    });
    
    // Portfolio All Route
    Route::controller(PortfolioController::class)->group( function () {
        Route::get('/all/portfolio', 'AllPortfolio')->name('all.portfolio');
        Route::get('/add/portfolio', 'AddPortfolio')->name('add.portfolio');
        Route::post('/store/portfolio', 'StorePortfolio')->name('store.portfolio');
        Route::get('/edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio');
        Route::put('/update/portfolio/{id}', 'UpdatePortfolio')->name('update.portfolio');
        Route::delete('/delete/portfolio/{id}', 'DeletePortfolio')->name('destroy.portfolio');
        Route::get('/portfolio/details/{id}', 'PortfolioDetails')->name('portfolio.details');
        Route::get('/portfolio', 'HomePortfolio')->name('home.portfolio');
    });

    // // BlogCategory All Route
    // Route::controller(BlogCategoryController::class)->group( function () {
    //     Route::get('/blog-categories', 'index')->name('blog-categories.index');
    //     // Route::put('/blog-categories/{id}', 'update')->name('blog-categories.update');
    // });

    // Blog Category using resource
    Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);
    Route::resource('blogs', BlogController::class)->except(['show']);
    Route::singleton('footer', FooterController::class)->except(['show']);

    
    
    // bagian dibawah ini Otomatis terbuat
    // GET /blog-categories (index): blog-categories.index
    // GET /blog-categories/create (create): blog-categories.create
    // POST /blog-categories (store): blog-categories.store
    // GET /blog-categories/{blog_category} (show): blog-categories.show
    // GET /blog-categories/{blog_category}/edit (edit): blog-categories.edit
    // PUT/PATCH /blog-categories/{blog_category} (update): blog-categories.update
    // DELETE /blog-categories/{blog_category} (destroy): blog-categories.destroy
    
});

//  Blogs all and show Routes
Route::get('blogs/all', [BlogController::class, 'all'])->name('blogs.all');
Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

// Blog-categories show Route
Route::get('blog-categories/{blog_category}', [BlogCategoryController::class, 'show'])->name('blog-categories.show');

// Footer Singleton Routes
Route::get('footer', [BlogController::class, 'show'])->name('footer.show');

// ContactController Routes
Route::controller(ContactController::class)->group(function() {
    Route::get('/contacts/create', 'create')->name('contacts.create');
    Route::post('/contacts/store', 'store')->name('contacts.store');
    Route::get('/contacts', 'index')->name('contacts.index');
    Route::delete('/contacts/{id}', 'destroy')->name('contacts.destroy');
});

require __DIR__.'/auth.php';
