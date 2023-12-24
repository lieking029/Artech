<?php

use App\Http\Controllers\ArtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MyPostController;
use App\Http\Controllers\VirtualGalleryController;
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
    return view('welcome');
});

Auth::routes();



Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // COMMON AND AUTHENTICATED
    Route::resource('virtual-gallery', VirtualGalleryController::class)->only('index');
    Route::resource('art', ArtController::class)->except('index');
    Route::resource('like', LikeController::class)->only('store');
    Route::resource('my-post', MyPostController::class)->only('index');

    Route::middleware('role:admin')->group(function() {
        Route::get('admin-home', [HomeController::class, 'adminHome'])->name('admin.home');
        Route::post('art-admin', [ArtController::class, 'adminStore'])->name('art.admin');
        Route::get('art', [ArtController::class, 'index'])->name('art.index');
        Route::get('approved/{art}', [ArtController::class, 'approved'])->name('art.approved');
        Route::get('disapproved/{art}', [ArtController::class, 'disapproved'])->name('art.disapproved');
    });

    Route::middleware('role:client')->group(function() {

    });

    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
