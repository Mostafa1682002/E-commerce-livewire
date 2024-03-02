<?php

use App\Http\Controllers\Dashboard\AdminAuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\HomeSliderController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileContoller;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\UserAuthController;
use App\Livewire\AboutComponent;
use App\Livewire\CartComponent;
use App\Livewire\CheckoutComponent;
use App\Livewire\ContactComponent;
use App\Livewire\DetailsComponent;
use App\Livewire\HomeComponent;
use App\Livewire\MyAccountComponent;
use App\Livewire\PrivacyPolicyComponent;
use App\Livewire\ShopComponent;
use App\Livewire\TermsCondistionsComponent;
use App\Livewire\WishlistComponent;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

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

Route::group(['controller' => UserAuthController::class], function () {
    Route::get('login-form', 'login_form')->name('login.form');
    Route::post('login', 'login')->name('login');
    Route::get('register-form', 'register_form')->name('register.form');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'logout')->name('logout');
});

Route::get('/', HomeComponent::class)->name('home');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/product/{id}', DetailsComponent::class)->name('product.details');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/checkout', CheckoutComponent::class)->name('checkout')->middleware(['auth', 'check_status_user']);
Route::get('/wishlist', WishlistComponent::class)->name('wishlist');
Route::get('/contact-us', ContactComponent::class)->name('contact');
Route::get('/privacy-policy', PrivacyPolicyComponent::class)->name('privacy_policy');
Route::get('/terms-condistions', TermsCondistionsComponent::class)->name('terms_condistions');
Route::get('/about-us', AboutComponent::class)->name('about');
Route::get('/my-account', MyAccountComponent::class)->name('my_account')->middleware(['auth', 'check_status_user']);



Route::get('/test', function () {
    // return Cart::instance('wishlist')->content();
    // return Cart::instance('wishlist')->destroy();
    return Cart::instance('cart')->content();
    // return Cart::instance('cart')->destroy();
});

///Dashboard
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['controller' => AdminAuthController::class], function () {
        Route::get('login', 'login_form')->name('login.form');
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
    Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');
    Route::resource('/slider', HomeSliderController::class);
    //Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.destroy');
    //Orders
    Route::resource('/orders', OrderController::class);
    //Profile
    Route::get('/profile', [ProfileContoller::class, 'profile'])->name('profile');
    Route::post('/profile', [ProfileContoller::class, 'updateProfile'])->name('profile.update');
});
