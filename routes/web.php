<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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

//-----Landing Page----//
Route::get('/', function () {
    return view('auth.login');
});

//-----Dashboard-----//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//-------Admin Routes----------//
Route::middleware(['admin'])->group(function () {
    //Add Product View
    Route::get('/addproduct', function () {
        return view('addproduct');
    })->name('add');
    //Store Product
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    //Manage Price View
    Route::get('/manage', function () {
        $products = Product::all();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('viewmanageprice', compact('products', 'users'));
    })->name('manageprice');
    //Store Prices
    Route::post('/price', [ProductController::class, 'manage'])->name('price.manage');
});

//Price list for user
Route::get('/list', [ProductController::class, 'viewlist'])->name('products.list')->middleware('simpleuser');


















Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
