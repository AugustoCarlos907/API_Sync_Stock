<?php

use App\Http\Controllers\AlertItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:api' , 'throttle:60,1'])->group(function(){

    //login 
    Route::post('login', [AuthController::class, 'login']);
    
    //companies
    Route::get('companies', [CompanyController::class, 'index']);
    Route::get('companies/{id}', [CompanyController::class, 'show']);
    Route::post('companies', [CompanyController::class, 'store']);


    //file upload
    Route::get('stock/files', [FileController::class, 'showUploadForm']);
    Route::post('stock/file/upload', [FileController::class, 'uploadFile']);
    
    //stock alerts
    Route::get('stock/alerts', [AlertItemController::class, 'getAlertItems']);
    Route::post('stock/alerts', [AlertItemController::class, 'sendStockAlerts']);

    // stock items
    // Listar dados extraídos de um ficheiro

});


