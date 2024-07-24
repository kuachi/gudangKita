<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardAccountController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\Inventory\BarangKeluarController;
use App\Http\Controllers\Inventory\BarangMasukController;
use App\Http\Controllers\Inventory\KonversiController;
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


Route::group(['middleware' => 'auth'], function(){
    /*
        Route Resource BE&FE
    */
    Route::resource('/dashboard/products', DashboardProductController::class);
    Route::resource('/dashboard/categories', DashboardCategoryController::class)->except(['show', 'create']);
    Route::resource('/dashboard/users', DashboardAccountController::class)->except('create');


    /*
        Route FrontEnd
    */
    Route::get('/dashboard/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    Route::get('/dashboard/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
    Route::get('/dashboard/konversi-barang', [KonversiController::class, 'index'])->name('konversi.index');

    /*
        Route API
    */
    Route::get('/get-produk-detail', [DashboardProductController::class, 'getDetail'])->name('produk.get-detail');
    Route::get('/get-barang-masuk', [BarangMasukController::class, 'get'])->name('barang-masuk.get');
    Route::get('/get-barang-keluar', [BarangKeluarController::class, 'get'])->name('barang-keluar.get');

    /*
        Route API seacrh
    */
    Route::get('/get-produk-barang-keluar', [BarangKeluarController::class, 'search'])->name('barang-keluar.search');
    Route::get('/get-produk', [DashboardProductController::class, 'get'])->name('produk.get');
    Route::get('/get-produk-konversi', [KonversiController::class, 'search'])->name('produk-konversi.get');
    Route::get('/get-produk-konversi-plu-asal', [KonversiController::class, 'searchPluAsal'])->name('produk-konversi-asal.get');
    Route::get('/get-produk-konversi-asal', [KonversiController::class, 'getDataKonv'])->name('produk-konversi.data');

    /*
        Route API create
    */
    Route::post('/barang-masuk', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
    Route::post('/barang-keluar', [BarangKeluarController::class, 'create'])->name('barang-keluar.create');
    Route::post('/konversi-plu', [KonversiController::class, 'create'])->name('produk-konversi.create');
});

