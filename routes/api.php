<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TarefasController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/getaccount', [AuthController::class, 'getaccount']);

    Route::prefix('usuarios')->group(function () {
        Route::get('/', [UsuariosController::class, 'index'])->name('usuarios.index');
        Route::patch('trocar-senha', [UsuariosController::class, 'changePassword']);
    });

    Route::apiResource('tarefas', TarefasController::class);
});

Route::post('/health', [HomeController::class, 'index']);
Route::post('/recuperar-senha', [AuthController::class, 'sendResetLink']);
Route::post('/resetar-senha', [AuthController::class, 'resetPassword']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::put('/usuarios/:id', [UsuariosController::class, 'update'])->name('usuarios.update');
