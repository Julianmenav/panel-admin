<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
*/



Auth::routes();


Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth','admin'])->group(function () {

    
    Route::get('/admin', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('admin');
    Route::post('/admin',  [App\Http\Controllers\AdminHomeController::class, 'create'])->name('event.create');
    Route::put('/admin',  [App\Http\Controllers\AdminHomeController::class, 'update'])->name('event.update');
    Route::delete('/admin',  [App\Http\Controllers\AdminHomeController::class, 'delete'])->name('event.delete');


    Route::get('/admin/users', [App\Http\Controllers\AdminUsersController::class, 'index'])->name('users');
    Route::get('/admin/users/edit', [App\Http\Controllers\AdminUsersController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users', [App\Http\Controllers\AdminUsersController::class, 'update'])->name('users.update');
    Route::delete('/admin/users', [App\Http\Controllers\AdminUsersController::class, 'delete'])->name('users.delete');


    Route::get('/admin/events', [App\Http\Controllers\AdminEventTypesController::class, 'index'])->name('eventTypes');
    Route::post('/admin/events', [App\Http\Controllers\AdminEventTypesController::class, 'create'])->name('eventTypes.create');
    Route::get('/admin/events/edit', [App\Http\Controllers\AdminEventTypesController::class, 'edit'])->name('eventTypes.edit');
    Route::put('/admin/events', [App\Http\Controllers\AdminEventTypesController::class, 'update'])->name('eventTypes.update');
    Route::delete('/admin/events', [App\Http\Controllers\AdminEventTypesController::class, 'delete'])->name('eventTypes.delete');

});