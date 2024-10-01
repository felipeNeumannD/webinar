<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;

Route::get('/', [LoginController::class, 'index']);
Route::get('/cadastro', [LoginController::class, 'signUp'])->name('cadastro.index');
Route::get('/login', [LoginController::class,'login'])->name('initialView');
Route::get('/mainView', [MainController::class,'index'])->name('mainView');

Route::post('/cadastrando', [LoginController::class, 'createUser']);

