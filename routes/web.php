<?php

use App\Http\Controllers\FornecedorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Fallback temporário até a integração da Spec 009 (Laravel Breeze).
if (! file_exists(__DIR__.'/auth.php')) {
    Route::get('/login', function () {
        return response('Autenticação necessária.', 200);
    })->name('login');
}

Route::middleware('auth')->group(function () {
    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar']);
    Route::get('/fornecedor/novo', [FornecedorController::class, 'novo']);
    Route::post('/fornecedor/salvar', [FornecedorController::class, 'salvar']);
    Route::get('/fornecedor/editar/{id}', [FornecedorController::class, 'editar']);
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir']);
});
