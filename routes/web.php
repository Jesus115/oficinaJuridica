<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientePortalController;
use App\Http\Controllers\ClienteAuthController;
use App\Http\Controllers\UserAuthController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('calendario', CalendarioController::class);
Route::resource('casos', CasoController::class);
Route::resource('clientes', ClienteController::class);
Route::prefix('casos/{caso}/tareas')->name('tareas.')->group(function () {
    Route::get('/', [TareaController::class, 'index'])->name('index');
    Route::get('/crear', [TareaController::class, 'create'])->name('create');
    Route::post('/', [TareaController::class, 'store'])->name('store');
    Route::get('/{tarea}', [TareaController::class, 'show'])->name('show');
    Route::get('/{tarea}/editar', [TareaController::class, 'edit'])->name('edit');
    Route::put('/{tarea}', [TareaController::class, 'update'])->name('update');
    Route::delete('/{tarea}', [TareaController::class, 'destroy'])->name('destroy');

    // Ruta para subir evidencia a la tarea
    Route::post('/{tarea}/evidencia', [TareaController::class, 'subirEvidencia'])->name('subirEvidencia');
});
Route::resource('usuarios', UserController::class);
Route::middleware(['auth:cliente'])->prefix('portal')->name('portal.')->group(function () {
    Route::get('/', [ClientePortalController::class, 'index'])->name('index');
    Route::get('/caso/{id}', [ClientePortalController::class, 'show'])->name('show');
});

Route::get('cliente/login', [ClienteAuthController::class, 'showLoginForm'])->name('cliente.login');
Route::post('cliente/login', [ClienteAuthController::class, 'login'])->name('cliente.login.submit');
Route::post('cliente/logout', [ClienteAuthController::class, 'logout'])->name('cliente.logout');


Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('login', [UserAuthController::class, 'login'])->name('user.login.submit');
Route::post('logout', [UserAuthController::class, 'logout'])->name('user.logout');
