<?php

use App\Http\Controllers\TranslateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [TranslateController::class, 'home'])->name('home');

Route::post('/translate', [TranslateController::class, 'translate'])->name('translate');
