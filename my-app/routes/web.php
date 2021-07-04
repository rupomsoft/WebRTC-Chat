<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JoinController;
use Illuminate\Support\Facades\Route;
Route::get('/',[HomeController::class,'Index']);
Route::get('/join',[JoinController::class,'Index']);
