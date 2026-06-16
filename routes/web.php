<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TriPayWebhookController;

Route::get('/', function () {
    return view('about');
});

Route::post('/webhook/tripay', [TriPayWebhookController::class, 'handle'])->name('tripay.webhook');
