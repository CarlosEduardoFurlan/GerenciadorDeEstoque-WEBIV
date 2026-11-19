@extends('template')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Detalhes da Forma de Pagamento</h1>
        <div class="d-flex gap-2">
            <a class="btn btn-primary" href="{{ route('formas-pagamento.edit', $formaPagamento) }}">Editar</a>
            <a class="btn btn-outline-secondary" href="{{ route('formas-pagamento.index') }}">Voltar</a>
        </div>
    </div>

    <dl class="row">
        <dt class="col-sm-3">Descrição</dt>
        <dd class="col-sm-9">{{ $formaPagamento->descricao }}</dd>

        <dt class="col-sm-3">Número de parcelas</dt>
        <dd class="col-sm-9">{{ $formaPagamento->numero_parcelas }}</dd>
    </dl>

    <h2 class="h4 mt-4">Itens</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>Parcela</th>
                    <th>Porcentagem</th>
                    <th>Prazo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formaPagamento->itens as $indice => $item)
                    <tr>
                        <td>{{ $indice + 1 }}</td>
                        <td>{{ number_format((float) $item->porcentagem, 2, ',', '.') }}%</td>
                        <td>{{ $item->dia }} dias</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

