<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopPageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
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
Route::put('/', [TopPageController::class, 'getRecommendMyList']);
Route::patch('/', [TopPageController::class, 'search']);
Route::get('/item', [TopPageController::class, 'show']);
Route::post('/purchase', [ItemController::class, 'toBuyPage']);
Route::post('/purchase/address', [PurchaseController::class, 'editAddress']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
