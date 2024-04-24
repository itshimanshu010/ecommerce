<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\BasketsController;
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

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/shopPage', [HomeController::class,'shopPage'])->name('shopPage');
Route::get('/singleProduct/{id}', [HomeController::class,'singleProduct'])->name('singleProduct');

Route::post('/add-to-cart', [BasketsController::class,'addToCart'])->name('cart.add');
Route::get('/show-cart',[BasketsController::class,'showCart'])->name('show-cart');
Route::get('/cart', [BasketsController::class, 'index'])->name('cart');
Route::get('/remove-cart', [BasketsController::class, 'removeItem'])->name('basket.remove');

Route::delete('/remove-cart-item', [BasketsController::class, 'removeCartItem'])->name('removeCartItem');
Route::delete('/remove-cart-item', [BasketsController::class, 'removeCartItem'])->name('removeCartItemaa');










Route::get('registerform',[AuthController::class,'showRegisterForm'])->name('showRegisterForm');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('loginform',[AuthController::class,'showUserLoginForm'])->name('showUserLoginForm');
Route::post('userlogin', [AuthController::class, 'userLogin'])->name('userLogin');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password',[ForgotPasswordController::class,'forgotPassword'])->name('forgotPassword');
// Route::post('/forgot-password',[ForgotPasswordController::class,'forgotPasswordpost'])->name('forgotPasswordpost');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');


Route::get('/userDashboard', [AuthController::class,'userDashboard'])->name('userDashboard');

// Route::get('/reset-password/{token}',[ForgotPasswordController::class,'resetPassword'])->name('resetPassword');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/admin.php';
