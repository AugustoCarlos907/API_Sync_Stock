<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth:api' , 'throttle:60,1'])->group(function(){

    Route::get('file/upload', function (){
    
    });
    
    Route::get('stock/alerts', function (){
    
    });
});


