<?php

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/sales', function () {
    return view('sales');
})->name('sales');

Route::middleware(['auth:sanctum', 'verified'])->get('user-datatables', function () {

    return view('users_dt');
});

Route::middleware(['auth:sanctum', 'verified'])->get('orders-datatables', function () {

    return view('orders_dt');
})->name('orders_dt');

Route::middleware(['auth:sanctum', 'verified'])->get('gray-frt-datatables', function () {

    return view('gray_frt_dt');
})->name('gray_frt_dt');

Route::middleware(['auth:sanctum', 'verified'])->get('tmc-datatables', function () {

    return view('tmc_dt');
})->name('tmc_dt');
