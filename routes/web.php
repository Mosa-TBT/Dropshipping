<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/', 
[App\Http\Controllers\MainPageController::class, 'index']);

Route::get('/shopping_cart', 
[App\Http\Controllers\ShoppingCartPageController::class, 'index']);

Route::get('/product/{id}', 
[App\Http\Controllers\ProductPageController::class, 'index']);

Route::get('/catagories/{catagory_name}', 
[App\Http\Controllers\CatagoryPageController::class, 'index']);

Route::get('/new-page/{product_catagory}', 
[App\Http\Controllers\NewPageController::class, 'index']);

Route::get('/products/search', 
[App\Http\Controllers\SearchPageController::class, 'index']);

Route::post('/product/{id}', 
[App\Http\Controllers\ProductPageController::class, 'store']);

Route::post('/', 
[App\Http\Controllers\ProductPageController::class, 'store']);

// Delete items from shopping cart 
Route::delete('/shopping_cart/delete_from_cart/{id}', 
[App\Http\Controllers\ShoppingCartPageController::class, 'destroy']);

// Delete all items from shopping cart
Route::delete('/shopping_cart/delete_all', 
[App\Http\Controllers\ShoppingCartPageController::class, 'destroy_all']);

// Payment ROUTES

// About us page
Route::get('/about', [App\Http\Controllers\FotterPagesController::class, 'showPages']);
// About us page

// FAQ 
Route::get('/faq', [App\Http\Controllers\FotterPagesController::class, 'showPages']);
// FAQ

// Contuct_us 
Route::get('/contuct', [App\Http\Controllers\FotterPagesController::class, 'showPages']);
// Contuct_us 

// Customer_support 
Route::get('/support', [App\Http\Controllers\FotterPagesController::class, 'showPages']);
// Customer_support 

// Save new subscriber
Route::post('/save_new_subscriber', [App\Http\Controllers\FotterPagesController::class, 'store']);
// Save new subscriber

// Varifying user email
Route::post('/send_email', [App\Http\Controllers\EmailVarificationController::class, 'sendEmail']);

Route::post('/varify_email', [App\Http\Controllers\EmailVarificationController::class, 'varifyEmail']);
// Varifying user email

// web.php
Route::get('/payment/{id}', [StripeController::class, 'stripe'])->name("stripe.form");
Route::post('/payment', [StripeController::class, 'stripePost'])->name('stripe.post');


Auth::routes();

Route::get('/home', 
[App\Http\Controllers\HomeController::class, 'index'])->name('home');

