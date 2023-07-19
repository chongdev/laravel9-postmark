<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\InboxController::class, "index"]);
Route::post('/send', [App\Http\Controllers\InboxController::class, "send"]);
