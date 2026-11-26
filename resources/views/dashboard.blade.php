@extends('template')

@section('conteudo')
    <h1 class="h3">Sistema de Compras e Vendas</h1>
    <p class="mb-0">Bem-vindo, {{ auth()->user()->name }}. Escolha um cadastro no menu para começar.</p>
@endsection
