<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubscriptionController;

//to employees
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::delete('/employees/document/{document}', [EmployeeController::class, 'destroy']);
Route::get('/employees/document/{document}', [EmployeeController::class, 'show']);
Route::put('/employees/document/{document}', [EmployeeController::class, 'update']);

//to equipments
Route::post('/equipments', [EquipmentController::class, 'store']);
Route::get('/equipments', [EquipmentController::class, 'index']);
Route::delete('/equipments/id/{id}', [EquipmentController::class, 'destroy']);
Route::get('/equipments/id/{id}', [EquipmentController::class, 'show']);
Route::put('/equipments/id/{id}', [EquipmentController::class, 'update']);

//to users
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/document/{document}', [UserController::class, 'show']);
Route::delete('/users/document/{document}', [UserController::class, 'destroy']);
Route::put('/users/document/{document}', [UserController::class, 'update']);

//to plans
Route::get('/plans', [PlanController::class, 'index']);
Route::post('/plans', [PlanController::class, 'store']);
Route::get('/plans/id/{id}', [PlanController::class, 'show']);
Route::delete('/plans/id/{id}', [PlanController::class, 'destroy']);
Route::put('/plans/id/{id}', [PlanController::class, 'update']);

//to subscriptions
Route::get('/subscriptions', [SubscriptionController::class, 'index']);
Route::post('/subscriptions', [SubscriptionController::class, 'store']);
Route::get('/subscriptions/id/{id}', [SubscriptionController::class, 'show']);
Route::delete('/subscriptions/id/{id}', [SubscriptionController::class, 'destroy']);
Route::put('/subscriptions/id/{id}', [SubscriptionController::class, 'update']);
