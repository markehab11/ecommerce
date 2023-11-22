<?php

use App\Http\Controllers\Api\AboutusController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SpesialproductController;
use App\Http\Controllers\Api\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::post('/category/{id}', [CategoryController::class, 'update']);
Route::post('/categories/{id}', [CategoryController::class, 'destroy']);

Route::get('/sliders', [SliderController::class, 'index']);
Route::get('/slider/{id}', [SliderController::class, 'show']);
Route::post('/sliders', [SliderController::class, 'store']);
Route::post('/slider/{id}', [SliderController::class, 'update']);
Route::post('/sliders/{id}', [SliderController::class, 'destroy']);

Route::get('products', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::post('/product/{id}', [ProductController::class, 'update']);
Route::post('/products/{id}', [ProductController::class, 'destroy']);

Route::get('/specialpro', [SpesialproductController::class, 'index']);
Route::get('/specialpro/{id}', [SpesialproductController::class, 'show']);
Route::post('/specialpro', [SpesialproductController::class, 'store']);
Route::post('/specialpro/{id}', [SpesialproductController::class, 'update']);
Route::post('/specialpro/{id}', [SpesialproductController::class, 'destroy']);

Route::get('/about_us', [AboutusController::class, 'index']);
Route::get('/about_us/{id}', [AboutusController::class, 'show']);
Route::post('/about_us', [AboutusController::class, 'store']);
Route::post('/about_us/{id}', [AboutusController::class, 'update']);
Route::post('/about_us/{id}', [AboutusController::class, 'destroy']);

Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'show']);
Route::post('/blogs', [BlogController::class, 'store']);
Route::post('/blog/{id}', [BlogController::class, 'update']);
Route::post('/blogs/{id}', [BlogController::class, 'destroy']);



