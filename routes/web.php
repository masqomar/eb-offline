<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('program/{id}/register', [\App\Http\Controllers\Front\RegistrationController::class, 'programRegister'])->name('registration.program.index');
Route::post('prosesDaftar', [\App\Http\Controllers\Front\RegistrationController::class, 'prosesDaftar'])->name('registration.program.prosesDaftar');
Route::get('/payment/{id}', [\App\Http\Controllers\Front\RegistrationController::class,  'payment'])->name('registration.program.payment');