<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('tasks', [Controller::class, 'index']);
Route::post('tasks', [Controller::class, 'store']);
Route::get('tasks/{id}', [Controller::class, 'show']);
Route::put('tasks/{id}', [Controller::class, 'update']);
Route::delete('tasks/{id}', [Controller::class, 'destroy']);
