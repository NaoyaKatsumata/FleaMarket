<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopPageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminPageController;
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

// Route::get('/',function(){
//     return view('user.welcome');
// });

Route::get('/admin-page', [AdminPageController::class, 'getUsers'])->middleware(['auth:admin', 'verified']);
Route::get('/admin-items', [AdminPageController::class, 'getItems'])->middleware(['auth:admin', 'verified']);
Route::post('/admin-page', [AdminPageController::class, 'delete'])->middleware(['auth:admin', 'verified']);
Route::get('/admin/item', [AdminPageController::class, 'comment'])->middleware(['auth:admin', 'verified']);
Route::patch('/comment', [AdminPageController::class, 'commentDelete'])->middleware(['auth:admin', 'verified']);
Route::put('/admin-page', [AdminPageController::class, 'sendMail']);
Route::post('/admin-message', [AdminPageController::class, 'message'])->middleware(['auth:admin', 'verified']);

Route::middleware('auth:users')->group(function () {
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
    Route::put('/mypage', [MypageController::class, 'shippingStore']);
    Route::post('/userProfile', [MypageController::class, 'showProfile']);
    Route::patch('/userProfile', [MypageController::class, 'store']);
    Route::post('/shipping', [MypageController::class, 'shipping']);
    Route::post('/comment', [ItemController::class, 'comment']);
    Route::put('/comment', [CommentController::class, 'store']);
    Route::get('/checkout', [PurchaseController::class, 'checkout']);
    Route::get('/thanks', [PurchaseController::class, 'thanks']);
    Route::get('/failed', [PurchaseController::class, 'failed']);
});

require __DIR__.'/auth.php';
