<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\MachineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;

Route::get('/', [LoginController::class, 'index']);

Route::prefix('user')->group(function () {
    Route::get('/cadastro', [LoginController::class, 'signUp'])->name('cadastro.index');
    Route::post('/login', [LoginController::class, 'login'])->name('initialView');
    Route::get('/changeUser', [LoginController::class, 'changeUser'])->name('changeUser');
    Route::put('/updateUser', [LoginController::class, 'updateUser']);
    Route::post('/cadastrando', [LoginController::class, 'createUser']);
    Route::get('/search-users', [LoginController::class, 'searchUser'])->name('searchUser');
});

Route::prefix('line')->group(function () {
    Route::get('/', [LineController::class, 'index'])->name('lines');
    Route::get('/cadastro', [LineController::class, 'create'])->name('line.cadastro');
    Route::get('/description', [LineController::class, 'showDescription'])->name('line.description');
    Route::post('/lineRegister', [LineController::class, 'lineRegister'])->name('line.register');
});

Route::prefix('machine')->group(function () {
    Route::get('/', [MachineController::class, 'index'])->name('machines');
    Route::get('/cadastro', [MachineController::class, 'create'])->name('machine.create');
    Route::get('/description', [MachineController::class, 'showDescription'])->name('machine.description');
    Route::post('/machineRegister', [MachineController::class, 'store'])->name('machine.store');
});

Route::prefix('course')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('course');
    Route::get('/cadastro', [CourseController::class, 'create'])->name('course.create');
    Route::get('/description', [CourseController::class, 'showDescription'])->name('course.description');
    Route::post('/courseRegister', [CourseController::class, 'store'])->name('course.store');
});


Route::prefix('main')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('mainView');
});




