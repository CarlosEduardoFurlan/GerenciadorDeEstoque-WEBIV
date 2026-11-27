<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FormaPagamentoController;
use App\Http\Controllers\FornecedorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/nova', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/editar', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/formas-pagamento', [FormaPagamentoController::class, 'index'])->name('formas-pagamento.index');
    Route::get('/formas-pagamento/novo', [FormaPagamentoController::class, 'create'])->name('formas-pagamento.create');
    Route::post('/formas-pagamento', [FormaPagamentoController::class, 'store'])->name('formas-pagamento.store');
    Route::get('/formas-pagamento/{formaPagamento}', [FormaPagamentoController::class, 'show'])->name('formas-pagamento.show');
    Route::get('/formas-pagamento/{formaPagamento}/editar', [FormaPagamentoController::class, 'edit'])->name('formas-pagamento.edit');
    Route::put('/formas-pagamento/{formaPagamento}', [FormaPagamentoController::class, 'update'])->name('formas-pagamento.update');
    Route::delete('/formas-pagamento/{formaPagamento}', [FormaPagamentoController::class, 'destroy'])->name('formas-pagamento.destroy');

    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar']);
    Route::get('/fornecedor/novo', [FornecedorController::class, 'novo']);
    Route::post('/fornecedor/salvar', [FornecedorController::class, 'salvar']);
    Route::get('/fornecedor/editar/{id}', [FornecedorController::class, 'editar']);
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir']);
});

require __DIR__.'/auth.php';
