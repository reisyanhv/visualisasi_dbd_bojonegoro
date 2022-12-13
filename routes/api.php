<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\PredictionCriteriaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cluster2018',[CriteriaController::class, 'cluster2018']); 
Route::get('/cluster2019',[CriteriaController::class, 'cluster2019']);
Route::get('/cluster2020',[CriteriaController::class, 'cluster2020']);
Route::get('/cluster2021',[CriteriaController::class, 'cluster2021']);
Route::get('/cluster_prediksi',[PredictionCriteriaController::class, 'cluster_prediksi']);