<?php

use App\Http\Controllers\AddToCartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageGenerationController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MyPostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VirtualGalleryController;

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
    // COMMON AND AUTHENTICATED
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::get('/home', [VirtualGalleryController::class, 'index'])->name('home');
    Route::resource('art', ArtController::class)->except('index');

    // My Post
    Route::get('my-post', [MyPostController::class, 'index'])->name('mypost.index');
    Route::post('my-post/{art}', [MyPostController::class, 'destroy'])->name('mypost.destroy');

    // Image Generator
    Route::get('/art-generate', [ImageGenerationController::class, 'imageGenerate'])->name('artpromp.index');

    // Like
    Route::post('/like/{id}', [LikeController::class, 'toggleLike']);

    // Add To Cart
    Route::post('/add/{id}', [AddToCartController::class, 'addToCart']);

    // Cart
    Route::get('cart', [AddToCartController::class, 'index'])->name('cart.index');
    Route::post('cart/{cart}', [AddToCartController::class, 'destroy'])->name('cart.destroy');

    // Art Details
    Route::get('/artValue/{id}', [MyPostController::class, 'getArtDetails']);
    Route::post('artUpdate/{art}', [MyPostController::class, 'update'])->name('art.update');
    Route::post('soldArt/{art}', [MyPostController::class, 'artSold'])->name('art.sold');

    Route::middleware('role:admin')->group(function () {
        Route::get('admin-home', [HomeController::class, 'adminHome'])->name('admin.home');
        Route::post('art-admin', [ArtController::class, 'adminStore'])->name('art.admin');
        Route::get('art', [ArtController::class, 'index'])->name('art.index');
        Route::get('approved/{art}', [ArtController::class, 'approved'])->name('art.approved');
        Route::get('disapproved/{art}', [ArtController::class, 'disapproved'])->name('art.disapproved');
    });

    Route::middleware('role:client')->group(function () {
    });

    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
