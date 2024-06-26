<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\LiveChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum', 'role:user|expert'])->group(function () {
    Route::post('/sendMessage', [ApiController::class, 'sendMessage']);
    Route::post('/sendChatMessage', [ApiController::class, 'sendChatMessage']);
});

