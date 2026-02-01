<?php

use App\Http\Controllers\AlertItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StockItemController;
use Illuminate\Support\Facades\Route;

//login 
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum' , 'throttle:60,1'])->group(function(){

    //companies
    Route::get('/companies', [CompanyController::class, 'index']);
    Route::get('/companies/{id}', [CompanyController::class, 'show']);
    Route::post('/companies/delete/{id}', [CompanyController::class, 'delete']);

    //file upload
    Route::get('/stock/files', [FileController::class, 'index']);
    Route::post('/stock/file/upload', [FileController::class, 'uploadFile']);
    
     // stock items
    Route::get('/stock/items', [StockItemController::class, 'index']);

    //stock alerts
    Route::get('/stock/alerts', [AlertItemController::class, 'getAlertItems']);
    Route::post('/stock/alerts', [AlertItemController::class, 'sendStockAlerts']);

   });


