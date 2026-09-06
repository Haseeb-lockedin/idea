<?php

declare(strict_types=1);

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StepController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ideas')->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');

Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth')->name('idea.index');
Route::post('/ideas', [IdeaController::class, 'store'])->middleware('auth')->name('idea.store');
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->middleware('auth')->name('idea.show');
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->middleware('auth')->name('idea.delete');

Route::patch('/steps/{step}', [StepController::class, 'update'])->middleware('auth')->name('step.update');

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');
