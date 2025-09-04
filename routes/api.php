<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EquipmentController;

Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::delete('/employees/document/{document}', [EmployeeController::class, 'destroy']);
Route::get('/employees/document/{document}', [EmployeeController::class, 'show']);
Route::put('/employees/document/{document}', [EmployeeController::class, 'update']);

//to equipments
Route::post('/equipments', [EquipmentController::class, 'store']);
