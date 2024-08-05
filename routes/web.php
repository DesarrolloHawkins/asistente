<?php

use App\Http\Controllers\AccionesController;
use App\Http\Controllers\ClientsController;
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

Route::get('/clients-create', [ClientsController::class, 'create'])->name('clients.create');
Route::get('/whatsapp', [App\Http\Controllers\WhatsappController::class, 'hookWhatsapp'])->name('whatsapp.hookWhatsapp');
Route::post('/whatsapp', [App\Http\Controllers\WhatsappController::class, 'processHookWhatsapp'])->name('whatsapp.processHookWhatsapp');
Route::get('/chatgpt/{texto}', [App\Http\Controllers\WhatsappController::class, 'chatGptPruebas'])->name('whatsapp.chatGptPruebas');

Route::get('/mensajes-whatsapp', [App\Http\Controllers\WhatsappController::class, 'whatsapp'])->name('whatsapp.mensajes');
Route::get('/acciones', [AccionesController::class, 'index'])->name('acciones.index');
Route::get('/acciones/enviar', [AccionesController::class, 'enviar'])->name('acciones.enviar');
Route::post('/acciones/enviar-mensajes', [AccionesController::class, 'enviarMensajes'])->name('acciones.enviarMensajes');
Route::post('/listar-mensajes/{id}', [AccionesController::class, 'listarMensajes'])->name('acciones.listarMensajes');
Route::post('/acciones/enviar-segmento-3', [AccionesController::class, 'enviarMensajesSegmentos'])->name('acciones.enviarMensajesSegmentos');

Route::post('/actualizar', [AccionesController::class, 'actualizar'])->name('acciones.actualizar');