<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;

Route::get('/', [EventController::class, 'index'])->middleware('auth');
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
//Route::get('events/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

Route::get('/events/{id}', [EventController::class, 'show'])->middleware('auth');
Route::post('/events', [EventController::class, 'store'])->middleware('auth');
Route::delete('/events/{id}',[EventController::class, 'destroy'])->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('/admin', [EventController::class, 'admin'])->middleware('auth');


//rota par  a admin criar usuarios e etc
Route::middleware('auth')->group(function () {

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);

    Route::get('/users/edit/{id}', [UserController::class, 'edit']);
    Route::put('/users/update/{id}', [UserController::class, 'update']);

    Route::delete('/users/{id}', [UserController::class, 'destroy']);

});


Route::get('/contact', function () {
    return view('contact');
});





//ROOTA DE DASHBOARDO QUE VEIO DO JETSTREAM
/**Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view ('dashboard');
    })->name('dashboard');
});*/


