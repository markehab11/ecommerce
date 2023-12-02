<?php

use App\Http\Controllers\Admin\AboutusController;
use App\Http\Controllers\Admin\AskController;
use App\Http\Controllers\Admin\blogController;
use App\Http\Controllers\Admin\DetailController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SpesialproductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\WhitelistController;
use App\Http\Controllers\User\WishlistController;
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

Route::get('/', function () {
    return view('user.stop');
});

Route::resource('sliders', SliderController::class);
Route::resource('details', DetailController::class);
Route::resource('spicial_pro', SpesialproductController::class);
Route::resource('aboutus', AboutusController::class);
Route::resource('blogs', blogController::class);
Route::resource('reviews', ProductReviewController::class);
Route::resource('asks', AskController::class);
Route::resource('questions', QuestionController::class);


Route::prefix('products')->name('product.')->group(function () {
    Route::get('/{product}',[ProductController::class,'show'])->name('show');
    Route::get('/{product}',[ProductController::class,'search'])->name('search');

});
Route::prefix('categories')->name('category.')->group(function () {
    Route::get('/{category}',[CategoryController::class,'show'])->name('show');
    Route::get('{category}/subcategories/{subcategory}',[CategoryController::class,'show_sub'])->name('show_sub');

});
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/',[CartController::class,'getCart'])->name('get');
    Route::post('/add_to_cart',[CartController::class,'addToCart'])->name('add');
    Route::post('/remove_item',[CartController::class,'removeFromCart'])->name('remove');
    Route::post('/inc_item',[CartController::class,'incItem'])->name('inc');
    Route::post('/dec_item',[CartController::class,'decItem'])->name('dec');
});
Route::prefix('checkout')->name('checkout.')->middleware('auth')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::put('/update',[CheckoutController::class,'update'])->name('update');
});
Route::prefix('order')->name('order.')->group(function(){
    Route::post('/', [OrderController::class, 'newOrder'])->name('store');

});
Route::prefix('wishlist')->name('wishlist.')->group(function () {
    Route::get('/',[WishlistController::class,'index'])->name('index');
    Route::post('/store',[WishlistController::class,'store'])->name('store');
    Route::delete('/{id}',[WishlistController::class,'destroy'])->name('destroy');
});
Route::get('/search',[SearchController::class,'index'])->name('search.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';