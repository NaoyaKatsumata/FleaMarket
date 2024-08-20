<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopPageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\MypageController;
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

Route::get('/', [TopPageController::class, 'getItems']);
Route::patch('/', [TopPageController::class, 'search']);
Route::get('/item', [TopPageController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/', [TopPageController::class, 'getRecommendMyList']);
    Route::patch('/item', [ItemController::class, 'myList']);
    Route::post('/purchase/edit', [PurchaseController::class, 'toEditAddressOrPay']);
    Route::post('/purchase', [ItemController::class, 'toBuyPage']);
    Route::patch('/purchase', [AddressController::class, 'editAddressOrPay']);
    Route::post('/mypage', [MypageController::class, 'show']);
    Route::patch('/mypage', [MypageController::class, 'editProfile']);
    Route::post('/userProfile', [MypageController::class, 'showProfile']);
    Route::patch('/userProfile', [MypageController::class, 'store']);
});

require __DIR__.'/auth.php';
