<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorld;
use App\Http\Controllers\Dashboard;

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


Route::get('/', [Dashboard::class, 'index']);
Route::get('/produk', [Dashboard::class, 'produk']);
Route::post('/produk', [Dashboard::class, 'tambahproduk']);
Route::get('/produk/tambah', [Dashboard::class, 'buatproduk']);
Route::get('/produk/{id}', [Dashboard::class, 'editproduk']);
Route::put('/produk/{id}', [Dashboard::class, 'putproduk']);
Route::delete('/produk/{id}', [Dashboard::class, 'hapusproduk']);

//route to controller
Route::get('/hello', [HelloWorld::class, 'index']);
