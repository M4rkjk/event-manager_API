<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\PasswordResetController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-password', [PasswordResetController::class, 'reset']);
Route::post('/reset-password-link', [PasswordResetController::class, 'sendResetLinkEmail']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/events', [EventController::class, 'index']);
    Route::get('/event/{id}', [EventController::class, 'show']);
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);

    Route::get('/me', function (Request $request) {
        return response()->json([
            'name' => $request->user()->name
        ]);
    });
});

Route::post('/helpdesk', [HelpdeskController::class, 'handle']);
