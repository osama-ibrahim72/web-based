<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' =>'api'
], function (){
    Route::apiResource('person', \App\Http\Controllers\PersonController::class);
});
