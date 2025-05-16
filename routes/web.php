<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Api\TaskApiController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Route::middleware(['auth'])->group(function () {
//     Route::resource('tasks', TaskController::class);
// });



Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth');
Route::get('/tasks/list', [TaskController::class, 'list'])->middleware('auth');
Route::post('/tasks', [TaskApiController::class, 'store'])->middleware('auth');
Route::post('/tasks/{task}/update', [TaskApiController::class, 'update'])->middleware('auth');
Route::post('/tasks/{task}/delete', [TaskApiController::class, 'destroy'])->middleware('auth');

require __DIR__.'/auth.php';
