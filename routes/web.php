<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

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




Route::get('/contact', function () {
    return view('contact');
});

use App\Models\User;

Route::get('/fix-admin-name', function () {

    User::where('email','matheus.baptista@citral.tur.br')
        ->update(['name' => 'Matheus']);

    User::where('email','adriano@citral.tur.br')
        ->update(['name' => 'Adriano']);

    return "Administradores atualizados!";
});




//ROOTA DE DASHBOARDO QUE VEIO DO JETSTREAM
/**Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/


