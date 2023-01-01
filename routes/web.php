<?php

use App\Http\Controllers\AccountController;
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
Route::post('/', [AccountController::class, 'authenticate']);
Route::post('/logout', [AccountController::class, 'logout']);
