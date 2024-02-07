<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartsController;
use App\Models\Product;
use App\Models\Cart;

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
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/home', function () {
    $products = Product::all();
    return view('home', ['products' => $products]);
});

Route::get('/cart', function () {
    $userId = Auth::id();
    $carts = Cart::where('user_id', $userId)->get();
    return view('cart', ['carts' => $carts]);
});

// Route::post('/register', 'App\Http\Controllers\UserController@register');

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/createProduct', [ProductsController::class, 'createProduct']);
Route::post('/addToCart', [ProductsController::class, 'addToCart']);

Route::post('/modifyQuantity', [CartsController::class, 'modifyQuantity']);
Route::post('/deleteItem', [CartsController::class, 'deleteItem']);
