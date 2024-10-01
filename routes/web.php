<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;

Route::get('/', [LoginController::class, 'index']);
Route::get('/cadastro', [LoginController::class, 'signUp'])->name('cadastro.index');
Route::get('/login', [LoginController::class,'login'])->name('initialView');
Route::get('/changeUser', [LoginController::class,'changeUser'])->name('changeUser');
Route::get('/mainView', [MainController::class,'index'])->name('mainView');

Route::put('/updateUser', [LoginController::class, 'updateUser']);

Route::post('/cadastrando', [LoginController::class, 'createUser']);

