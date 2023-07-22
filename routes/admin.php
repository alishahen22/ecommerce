<?php

use App\Models\Feature;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AddQuentityController;
use App\Http\Controllers\Admin\AuthController;
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
//route middleware
Route::middleware('admin')->group(function () {
    Route::get('/', function () {
        return View('admin.index');
      })->name('admin.home');
      Route::resource('admin', AdminController::class);
      Route::resource('category', CategoryController::class);
      Route::resource('tag', TagController::class);
      Route::resource('slider', SliderController::class);

      Route::resource('product', ProductController::class);

      //add images to product
      Route::post('products/add-image', [ProductController::class, 'SaveImages'])->name('product.add-images');
      Route::delete('products/delete-image', [ProductController::class, 'deleteimage'])->name('product.delete-image');
      //add props to product
      Route::post('products/add-prop', [ProductController::class, 'saveProp'])->name('product.add-props');
      Route::put('products/update-prop/{id}', [ProductController::class, 'updateProp'])->name('product.update-prop');
      Route::delete('products/delete-prop/{id}', [ProductController::class, 'deleteProp'])->name('product.delete-prop');
      //add features
      Route::resource('feature', FeatureController::class);

      Route::get('feature/{id}/addValue', [FeatureController::class, 'addValueToFeature'])->name('feature.addValue');
      Route::post('feature/addValue', [FeatureController::class, 'storeValueToFeature'])->name('feature.values.store');
      Route::delete('feature/{id}/deleteValue', [FeatureController::class, 'deleteValue'])->name('feature.values.delete');

      //add quentity and feature to product
      Route::get('Products/addquentity', [AddQuentityController::class, 'selectProduct'])->name('product.SelectProduct');
      Route::get('Products/{id}/quentity', [AddQuentityController::class, 'showQuentityToProduct'])->name('product.showQuentityToProduct');
      Route::get('add/quentity/{id}', [AddQuentityController::class, 'addQuentity'])->name('product.addQuentityToProduct');
      Route::post('Products/addquentity', [AddQuentityController::class, 'storeQuentityToProduct'])->name('product.storeQuentity');

      // order routes
      Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
      Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');
      Route::post('updatestatus/{id}', [OrderController::class, 'updateStatus'])->name('status.update');

      //contact us
      Route::get('contact', [AdminController::class, 'contact'])->name('contact.index');


//logout
Route::Post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

//admin login
Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/login', [AuthController::class, 'checkLogin'])->name('admin.checkLogin');





// <form action="{{ route('test') }}" method="post">
// @csrf
// {{-- //جيب الخواص اللي موجودة في المنتج --}}
// @foreach ($product->features as $feature)
//     <label>{{ $feature->name_ar }}</label>
//     {{-- عملت سيليكت بيها --}}
//     <select class="form-control" name="{{ $feature->id }}" id="{{ $feature->id }}">
//         @php
//         // اراي عشان الفاليوز متكررة متتضافش
//             $selectedValues = [];
//         @endphp
//         @foreach ($quentities as $quentity)
//             @foreach ($quentity->features as $key => $value)
//                 @if ($key == $feature->id)
//                     @php
//                         $featureValue = \App\Models\FeatureValue::find($value);
//                     @endphp
//                     {{-- اذا كانت القيمة موجودة في السيليكت متعملش اوبشن --}}
//                     @if ($featureValue && !in_array($featureValue->id, $selectedValues))
//                         <option value="{{ $featureValue->id }}">{{ $featureValue->value_ar }}</option>
//                         @php
//                             $selectedValues[] = $featureValue->id;
//                         @endphp
//                     @endif
//                 @endif
//             @endforeach
//         @endforeach
//     </select>
// @endforeach
// <input type="submit" >
// </form>
