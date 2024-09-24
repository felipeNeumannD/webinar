<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'index']);
Route::get('/cadastro', [LoginController::class, 'signUp'])->name('cadastro.index');


Route::post('/cadastrando', [LoginController::class, 'createUser']);

