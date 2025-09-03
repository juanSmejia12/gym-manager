<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('api')->group(function () {
    Route::resource('employees', App\Http\Controllers\EmployeeController::class);
    // Rutas protegidas por el middleware 'api'
});
