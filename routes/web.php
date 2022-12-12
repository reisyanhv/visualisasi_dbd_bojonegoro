<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubdistrictController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\PredictionCriteriaController;

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
Route::get('/data', [CriteriaController::class, 'index']);
Route::get('/data/{id}', [CriteriaController::class, 'view']);
Route::get('/prediksi', [PredictionCriteriaController::class, 'index']);
Route::get('/informasi', function () {
    return view('informasi');
});
Route::get('/grafik',[ResultController::class, 'grafik']);
Route::get('/peta', function () {
    return view('peta');
});
