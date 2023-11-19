<?php

use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Seller\Auth\LoginController;
use App\Http\Controllers\Seller\Auth\ProfileController;
use App\Http\Controllers\Seller\PagesContoller;
use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class,'create'])->name('seller.login')->middleware(['guest:seller']);
Route::post('/login',[LoginController::class,'store'])->name('seller.store');

Route::middleware(['seller'])->name('seller.')->group(function () {
    Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
    Route::get('/',[PagesContoller::class,'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('subcategories/getsubcategory/{category}',[SubcategoryController::class,'getSubCategories'])->name('subcategories.softDelete');

    Route::delete('products/softDelete/{product}',[ProductController::class,'softDelete'])->name('products.softDelete');
    Route::delete('products/image/{id}/delete',[ProductController::class,'deleteImage'])->name('products.deleteImage');

    Route::post('products/restore/{products}',[ProductController::class,'restore'])->name('products.restore');
    Route::resource('products',ProductController::class);

});
