<?php

use App\Http\Controllers\Frontend\CheckoutController;

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

// Frontend Routes
Route::get('/', [\App\Http\Controllers\Frontend\HomepageController::class, 'index'])->name('homepage');
Route::get('daftar-mobil', [\App\Http\Controllers\Frontend\CarController::class, 'index'])->name('car.index');
Route::get('daftar-mobil/{car}', [\App\Http\Controllers\Frontend\CarController::class, 'show'])->name('car.show');
Route::post('daftar-mobil', [\App\Http\Controllers\Frontend\CarController::class, 'store'])->name('car.store');
Route::get('blog', [\App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{blog:slug}', [\App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('blog.show');
Route::get('tentang-kami', [\App\Http\Controllers\Frontend\AboutController::class, 'index'])->name('about.index');
Route::get('kontak', [\App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('contact.index');
Route::post('kontak', [\App\Http\Controllers\Frontend\ContactController::class, 'store'])->name('contact.store');

// Auth Routes
Auth::routes();

// Rute yang hanya bisa diakses jika pengguna sudah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

// Admin Routes - hanya bisa diakses oleh admin
Route::group(['middleware' => ['auth', 'is_admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    // Rute untuk menampilkan profil admin
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');

    // Rute untuk update profil admin
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Admin resources
    Route::resource('cars', \App\Http\Controllers\Admin\CarController::class);
    Route::resource('types', \App\Http\Controllers\Admin\TypeController::class);
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
    Route::resource('teams', \App\Http\Controllers\Admin\TeamController::class);
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class)->only(['index', 'store', 'update']);
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->only(['index', 'destroy']);
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class)->only(['index', 'destroy']);
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
});

Route::get('/checkout/{booking_id}', [CarController::class, 'checkout'])->name('frontend.checkout');
Route::get('/payment/midtrans/{booking_id}', [CarController::class, 'paymentPage'])->name('frontend.payment.midtrans');


Route::get('/checkout/{booking_id}', [CheckoutController::class, 'show'])->name('frontend.checkout');
