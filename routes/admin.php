<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/',[LoginController::class,'showLoginForm'])->name('showLoginForm');
    Route::post('adminlogin',[LoginController::class,'adminLogin'])->name('adminLogin');
    Route::get('adminReset',[ResetPasswordController::class,'adminReset'])->name('adminReset');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    
});


Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');
   

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::get('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');


    Route::get('/adminLogout', [LoginController::class, 'adminLogout'])->name('adminLogout');

    Route::get('/adminProfile', [LoginController::class, 'adminProfile'])->name('adminProfile');
    Route::put('/admin/profile-update', [LoginController::class, 'profileUpdate'])->name('profileUpdate');

    Route::get('/adminPassword', [LoginController::class, 'adminPassword'])->name('adminPassword');
    Route::put('/admin/password-update/{id}', [LoginController::class, 'passwordUpdate'])->name('passwordUpdate');


    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/subcategories/{id}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/subcategories/{id}', [SubCategoryController::class, 'update'])->name('subcategories.update');
    Route::get('/subcategories/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');


    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}/variants/create', [ProductController::class, 'showVariantCreateForm'])->name('products.variants');
    Route::post('/products/{id}/variants/store', [ProductController::class, 'storeVariant'])->name('products.storevariant');
    


});
