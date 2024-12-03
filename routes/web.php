<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\MachineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/main', [MainController::class, 'index'])->name('mainView');
});

Route::prefix('user')->group(function () {
    Route::get('/cadastro', [LoginController::class, 'signUp'])->name('cadastro.index');
    Route::post('/login', [LoginController::class, 'loginAct'])->name('initialView');
    Route::get('/changeUser', [LoginController::class, 'changeUser'])->name('changeUser');
    Route::put('/updateUser', [LoginController::class, 'updateUser']);
    Route::post('/cadastrando', [LoginController::class, 'createUser']);
    Route::get('/search-users', [LoginController::class, 'searchUser'])->name('searchUser');
    Route::get('/old-search-users', [LoginController::class, 'oldSearchUser'])->name('old-search-users');
    Route::get('/{courseId}/course', [LoginController::class, 'getUsersByCourse'])->name('course-users');
});

Route::prefix('line')->group(function () {
    Route::get('/', [LineController::class, 'index'])->name('lines');
    Route::get('/cadastro', [LineController::class, 'create'])->name('line.cadastro');
    Route::get('/{id}/description', [LineController::class, 'showDescription'])->name('line.description');
    Route::post('/lineRegister', [LineController::class, 'lineRegister'])->name('line.register');
    Route::get('/{id}/edit', [LineController::class, 'edit'])->name('lines.edit');
    Route::put('/{id}', [LineController::class, 'update'])->name('lines.update');
    Route::delete('/{id}', [LineController::class, 'destroy'])->name('lines.destroy');
});

Route::prefix('machine')->group(function () {
    Route::get('/', [MachineController::class, 'index'])->name('machines');
    Route::get('/cadastro', [MachineController::class, 'create'])->name('machine.create');
    Route::get('/{id}/description', [MachineController::class, 'showDescription'])->name('machine.description');
    Route::post('/machineRegister', [MachineController::class, 'store'])->name('machine.store');
    Route::get('/{id}/edit', [MachineController::class, 'edit'])->name('machines.edit');
    Route::put('/{id}', [MachineController::class, 'update'])->name('machines.update');
    Route::delete('/{id}', [MachineController::class, 'destroy'])->name('machines.destroy');
    Route::post('/addUser', [MachineController::class, 'storeUser'])->name('assign.machine.store');
});

Route::prefix('course')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('courses');
    Route::get('/cadastro/{id}', [CourseController::class, 'create'])->name('course.create');
    Route::get('/{id}/description', [CourseController::class, 'showDescription'])->name('course.description');
    Route::post('/courseRegister/{id}/register', [CourseController::class, 'store'])->name('course.store');
    Route::get('{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::post('/addCourseUser', [CourseController::class, 'storeUser'])->name('assign.course.store');


    Route::delete('/class/{id}', [CourseController::class, 'destroyClass'])->name('classes.destroy');
    Route::get('/{id}/class/content', [CourseController::class, 'exploreClass'])->name('class.explore');
    Route::post('/{id}/class/register', [CourseController::class, 'storeClass'])->name('class.store');
    Route::post('/{id}/class/answers', [CourseController::class, 'checkAnswer'])->name('check-answers');
    Route::post('/save-video-progress', [CourseController::class, 'saveVideoProgress'])->name('video.progress');

    Route::get('/{id}/class/show_video', [CourseController::class, 'showVideos'])->name('video.show');

});









