<?php

use App\Http\Controllers\front\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Front\HomeController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.index');
// });
// front


Route::get('/' ,[ HomeController::class, 'index']);
Route::get('/lang/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('lang');

 //Route::get('/shop' ,[ HomeController::class, 'shop']);
 Route::get('/shop' ,[ HomeController::class, 'showCategory'])->name('shop.category');
 Route::post('/addtocart' ,[ HomeController::class, 'addToCart'])->name('shop.addToCart');
 Route::get('/cart' ,[ HomeController::class, 'cart'])->name('cart');
 Route::get('/addQuentityToCart' ,[ HomeController::class, 'addQuentityToCart'])->name('addQuentityToCart');
 Route::get('/deleteFromCart/{id}' ,[ HomeController::class, 'deleteFromCart'])->name('deleteFromCart');
 Route::post('/checkout' ,[ HomeController::class, 'storeCheckout'])->name('checkout');

 Route::get('/orders' ,[ OrderController::class, 'index'])->name('front.orders.index');
Route::get('/order/{id}' ,[ OrderController::class, 'show'])->name('front.order.show');


 //cart 1
 Route::post('/logout' ,[ HomeController::class, 'userLogout'])->name('user-logout');
    Route::post('/contact' ,[ HomeController::class, 'storeContact'])->name('contact.store');

    //contact in admin

//  ,و فيه الكمية زودت لون في جدول اليوزر عملت جدول للحجم هيبقي فيه بينه و بين البرودكت علاقة
// many to many
// وقفت جدول

// features
// feature_product
// feature_values
// product_sizes


//اضافة حجم ف الداشبورد

