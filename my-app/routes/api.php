<?php

use App\Http\Controllers\JoinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/AddJoin',[JoinController::class,'AddJoin']);

Route::get('/ActiveList/{mobile}',[JoinController::class,'ActiveList']);

Route::get('/CheckMobileNumberIsActive/{mobile}',[JoinController::class,'CheckMobileNumberIsActive']);
