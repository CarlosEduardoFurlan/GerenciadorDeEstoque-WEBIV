<?php

use App\Http\Controllers\FormaPagamentoController;
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
