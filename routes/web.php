<?php

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

use App\Http\Controllers\TarefasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function() { return redirect()->route('login'); });

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/logar', [LoginController::class, 'logar'])->name('logar');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', [UsuariosController::class, 'index'])->name('usuarios.listar');
        Route::get('/novo', [UsuariosController::class, 'novo'])->name('usuarios.novo');
        Route::post('/cadastrar', [UsuariosController::class, 'cadastrar'])->name('usuarios.cadastrar');
        Route::get('/edicao/{id}', [UsuariosController::class, 'edicao'])->name('usuarios.edicao');
        Route::post('/editar/{id}', [UsuariosController::class, 'editar'])->name('usuarios.editar');
        Route::get('/excluir/{id?}', [UsuariosController::class, 'excluir'])->name('usuarios.excluir');
    });

    Route::group(['prefix' => 'tarefas'], function () {
        Route::get('/', [TarefasController::class, 'index'])->name('tarefas.listar');
        Route::get('/excluir/{id?}', [TarefasController::class, 'excluir'])->name('tarefas.excluir');
    });

});

