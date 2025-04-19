<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\WebsiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/website', function () {
    return view('website');
});




Route::get('/', [MainController::class, 'welcome'])->name('welcome');

Route::post('/formcheck', [MainController::class, 'form_check']);

Route::get("getItem", [MainController::class, 'getItem'])->name('getItem');

Route::post('/formchek', [MainController::class, 'saveFile']);

Route::delete('/items/{id}', [MainController::class, 'deleteItem'])->name('deleteItem');

Route::put('/items/{id}', [MainController::class, 'updateItem']);

Route::get('/scan', [MainController::class, 'scanQr'])->name('scanQr');  // Страница для сканирования QR

Route::get('/product/{id}', [MainController::class, 'viewProduct'])->name('viewProduct');  // Страница для товара по ID

Route::get('/product/{id}', [MainController::class, 'show'])->name('product.show');


Route::get("/website", [WebsiteController::class, 'website'])->name('website');

Route::delete('/item/{id}', [WebsiteController::class, 'destroy'])->name('item.delete');


Route::post('/productpage/{id}/review', [WebsiteController::class, 'review_check'])->name('review_check');

Route::get('/productpage/{id}', [WebsiteController::class, 'showProductpage'])->name('productpage.show');

Route::post('/cart/add/{id}', [WebsiteController::class, 'add'])->name('cart.add');

Route::get('/cart', [WebsiteController::class, 'index'])->name('cart.index');

Route::post('/cart/remove', [websiteController::class, 'remove'])->name('cart.remove');


Route::get('/order/create', [websiteController::class, 'create'])->name('order.create');

Route::post('/cart/clear', [websiteController::class, 'clear'])->name('cart.clear');
