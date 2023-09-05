<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();


Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth','admin'])->group(function () {
    
    Route::get('/admin', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('admin');
    Route::get('/admin/users', [App\Http\Controllers\AdminUsersController::class, 'index'])->name('users');
    // Cambiar por AdminEventTypesController name('types o eventTypes')
    Route::get('/admin/events', [App\Http\Controllers\AdminCalendarEventsController::class, 'index'])->name('events');

    Route::post('/admin',  [App\Http\Controllers\AdminHomeController::class, 'create'])->name('event.create');


});