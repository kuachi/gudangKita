<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardAccountController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\Inventory\BarangMasukController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index', [
        'title' => 'Login Page'
    ]);
})->name('login')->middleware('guest');

Route::get('/info', function (){
    return view('info', [
        'title' => 'Info Page'
    ]);
});



// dashboard route
Route::get('/dashboard', function(){
    return view('dashboard.index', [
        'title' => 'Dashboard'
    ]);
})->middleware('auth');


// login route
Route::post('/', [AccountController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [AccountController::class, 'logout']);


// products resource
Route::resource('/dashboard/products', DashboardProductController::class)->middleware('auth');

// categories resource
Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('auth')->except(['show', 'create']);

// users resource
Route::resource('/dashboard/users', DashboardAccountController::class)->middleware('auth')->except('create');



Route::get('/dashboard/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.create');
Route::get('/get-produk', [DashboardProductController::class, 'get'])->name('produk.get');
Route::get('/get-produk-detail', [DashboardProductController::class, 'getDetail'])->name('produk.get-detail');

Route::get('/get-barang-masuk', [BarangMasukController::class, 'get'])->name('barang-masuk.get');
Route::post('/barang-masuk', [BarangMasukController::class, 'create'])->name('barang-masuk.create');

