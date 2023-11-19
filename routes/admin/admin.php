<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PagesContoller;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class,'create'])->name('admin.login')->middleware(['guest:admin']);
Route::post('/login',[LoginController::class,'store'])->name('admin.store');

Route::middleware(['admin'])->name('admin.')->group(function () {
    Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
    Route::get('/',[PagesContoller::class,'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('categories/softDelete/{category}',[CategoryController::class,'softDelete'])->name('categories.softDelete');
    Route::post('categories/restore/{category}',[CategoryController::class,'restore'])->name('categories.restore');
    Route::resource('categories',CategoryController::class);

    Route::delete('subcategories/softDelete/{subcategory}',[SubcategoryController::class,'softDelete'])->name('subcategories.softDelete');
    Route::get('subcategories/getsubcategory/{category}',[SubcategoryController::class,'getSubCategories']);

    Route::post('subcategories/restore/{subcategory}',[SubcategoryController::class,'restore'])->name('subcategories.restore');
    Route::resource('subcategories',SubcategoryController::class);


    Route::delete('products/softDelete/{product}',[ProductController::class,'softDelete'])->name('products.softDelete');
    Route::delete('products/image/{id}/delete',[ProductController::class,'deleteImage'])->name('products.deleteImage');

    Route::post('products/restore/{products}',[ProductController::class,'restore'])->name('products.restore');
    Route::resource('products',ProductController::class);

    Route::delete('shops/softDelete/{id}',[ShopController::class,'softDelete'])->name('shops.softDelete');
    Route::post('shops/restore/{id}',[ShopController::class,'restore'])->name('shops.restore');
    Route::resource('shops',ShopController::class);

    Route::delete('orders/softDelete/{id}',[OrderController::class,'softDelete'])->name('orders.softDelete');
    Route::post('orders/restore/{id}',[OrderController::class,'restore'])->name('orders.restore');
    Route::resource('orders',OrderController::class);


});
