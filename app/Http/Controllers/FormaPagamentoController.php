<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormaPagamentoRequest;
use App\Models\FormaPagamento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FormaPagamentoController extends Controller
{
    public function index(): View
    {
        $formasPagamento = FormaPagamento::query()
            ->orderBy('descricao')
            ->paginate(10);

        return view('formas_pagamento.index', compact('formasPagamento'));
    }

    public function create(): View
    {
        return view('formas_pagamento.form', [
            'formaPagamento' => new FormaPagamento,
            'itens' => [['porcentagem' => '', 'dia' => '']],
        ]);
    }

    public function store(FormaPagamentoRequest $request): RedirectResponse
    {
        $dados = $request->validated();

        DB::transaction(function () use ($dados): void {
            $formaPagamento = FormaPagamento::create([
                'descricao' => $dados['descricao'],
                'numero_parcelas' => $dados['numero_parcelas'],
            ]);

            $formaPagamento->itens()->createMany($dados['itens']);
        });

        return to_route('formas-pagamento.index')
            ->with('success', 'Forma de pagamento cadastrada com sucesso.');
    }

    public function show(FormaPagamento $formaPagamento): View
    {
        $formaPagamento->load('itens');

        return view('formas_pagamento.show', compact('formaPagamento'));
    }

    public function edit(FormaPagamento $formaPagamento): View
    {
        $formaPagamento->load('itens');

        return view('formas_pagamento.form', [
            'formaPagamento' => $formaPagamento,
            'itens' => $formaPagamento->itens->map(fn ($item): array => [
                'porcentagem' => $item->porcentagem,
                'dia' => $item->dia,
            ])->all(),
        ]);
    }

    public function update(
        FormaPagamentoRequest $request,
        FormaPagamento $formaPagamento
    ): RedirectResponse {
        $dados = $request->validated();

        DB::transaction(function () use ($dados, $formaPagamento): void {
            $formaPagamento->update([
                'descricao' => $dados['descricao'],
                'numero_parcelas' => $dados['numero_parcelas'],
            ]);

            $formaPagamento->itens()->delete();
            $formaPagamento->itens()->createMany($dados['itens']);
        });

        return to_route('formas-pagamento.index')
            ->with('success', 'Forma de pagamento atualizada com sucesso.');
    }

    public function destroy(FormaPagamento $formaPagamento): RedirectResponse
    {
        DB::transaction(fn () => $formaPagamento->delete());

        return to_route('formas-pagamento.index')
            ->with('success', 'Forma de pagamento excluída com sucesso.');
    }
}
