@extends('template')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">{{ $formaPagamento->exists ? 'Editar Forma de Pagamento' : 'Nova Forma de Pagamento' }}</h1>
        <a class="btn btn-outline-secondary" href="{{ route('formas-pagamento.index') }}">Voltar</a>
    </div>

    <form
        method="POST"
        action="{{ $formaPagamento->exists ? route('formas-pagamento.update', $formaPagamento) : route('formas-pagamento.store') }}"
    >
        @csrf
        @if ($formaPagamento->exists)
            @method('PUT')
        @endif

        @include('formas_pagamento._form')

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a class="btn btn-secondary" href="{{ route('formas-pagamento.index') }}">Cancelar</a>
        </div>
    </form>
@endsection

