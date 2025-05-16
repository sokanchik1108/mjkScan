<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/website', function () {
    return view('website');
});

Route::get('/payment', function () {
    return view('payment');
})->name('payment');


Route::get('/information', function () {
    return view('partials.information');
})->name('information');

Route::get('/', [MainController::class, 'welcome'])->name('welcome');

Route::post('/formcheck', [MainController::class, 'form_check']);

Route::get('/getItem', [MainController::class, 'getItem'])->name('getItem');

Route::delete('/items/{id}', [MainController::class, 'deleteItem'])->name('deleteItem');

Route::put('/updateitems/{id}', [MainController::class, 'updateItem']);

Route::get('/scan', [MainController::class, 'scanQr'])->name('scanQr');  // Страница для сканирования QR

Route::get('/product/{id}', [MainController::class, 'show'])->name('product.show');

Route::put('/product/{id}/update', [MainController::class, 'updateQuantity'])->name('update_quantity');

Route::get("/website", [WebsiteController::class, 'website'])->name('website');

Route::delete('/item/{id}', [WebsiteController::class, 'destroy'])->name('item.delete');

Route::post('/productpage/{id}/review', [WebsiteController::class, 'review_check'])->name('review_check');

Route::get('/productpage/{id}', [WebsiteController::class, 'showProductpage'])->name('productpage.show');

Route::post('/cart/add/{id}', [WebsiteController::class, 'add'])->name('cart.add');

Route::get('/cart', [WebsiteController::class, 'index'])->name('cart.index');

Route::post('/cart/remove', [websiteController::class, 'remove'])->name('cart.remove');

Route::post('/cart/clear', [websiteController::class, 'clear'])->name('cart.clear');

Route::get('/category/{category}', [WebsiteController::class, 'showItemsByCategory'])->name('categories.items');

Route::get('/websitegetItem', [WebsiteController::class, "websitegetItem"])->name('websitegetItem');

Route::put('/updatewebsiteItems/{id}', [WebsiteController::class, 'updatewebsiteItem'])->name('updatewebsiteItems');

Route::get('api/types/{categoryId}', [WebsiteController::class, 'getTypes'])->name('api.types');

Route::get('/categories/{id}/types', [WebsiteController::class, 'getTypes']);

// Для показа товаров определённого типа в категории
Route::get('categories/{categoryId}/types/{typeId}', [WebsiteController::class, 'show'])->name('types.show');

Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');


 Route::get('/admin/orders', [PaymentController::class, 'adminOrders'])->name('admin.orders');

 Route::post('/admin/orders/{id}/update-status', [PaymentController::class, 'updateStatuses'])->name('orders.updateStatuses');

 Route::delete('/admin/orders/{id}', [PaymentController::class, 'destroy'])->name('orders.destroy');

 Route::get('/get-types-by-category/{categoryId}', [WebsiteController::class, 'getTypesByCategory']);








