<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubdistrictController;

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
    return view('informasi');
});
// Route::get('/data', function () {
//     return view('data');
// });
Route::get('/data', [SubdistrictController::class, 'index']);
Route::get('/informasi', function () {
    return view('informasi');
});
Route::get('/grafik', function () {
    return view('grafik');
});
Route::get('/peta', function () {
    return view('peta');
});
