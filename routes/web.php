<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/',[MainController::class, 'welcome'])->name ('welcome'); 

Route::post('/formcheck', [MainController::class, 'form_check']);

Route::get("getItem",[MainController::class,'getItem'])->name('getItem');


Route::post('/formchek', [MainController::class, 'saveFile']);


Route::delete('/items/{id}', [MainController::class, 'deleteItem'])->name('deleteItem');

Route::put('/items/{id}', [MainController::class, 'updateItem']);


Route::get('/scan', [MainController::class, 'scanQr'])->name('scanQr');  // Страница для сканирования QR
Route::get('/product/{id}', [MainController::class, 'viewProduct'])->name('viewProduct');  // Страница для товара по ID











