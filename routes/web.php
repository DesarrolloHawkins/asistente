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

Route::get('/whatsapp', [App\Http\Controllers\WhatsappController::class, 'hookWhatsapp'])->name('whatsapp.hookWhatsapp');
Route::post('/whatsapp', [App\Http\Controllers\WhatsappController::class, 'processHookWhatsapp'])->name('whatsapp.processHookWhatsapp');
Route::get('/chatgpt/{texto}', [App\Http\Controllers\WhatsappController::class, 'chatGptPruebas'])->name('whatsapp.chatGptPruebas');

Route::get('/mensajes-whatsapp', [App\Http\Controllers\WhatsappController::class, 'whatsapp'])->name('whatsapp.mensajes');
