@extends('template')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Formas de Pagamento</h1>
        <a class="btn btn-primary" href="{{ route('formas-pagamento.create') }}">
            <i class="bi bi-plus-lg"></i> Nova Forma de Pagamento
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Número de parcelas</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($formasPagamento as $formaPagamento)
                    <tr>
                        <td>{{ $formaPagamento->id }}</td>
                        <td>{{ $formaPagamento->descricao }}</td>
                        <td>{{ $formaPagamento->numero_parcelas }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('formas-pagamento.show', $formaPagamento) }}" aria-label="Visualizar {{ $formaPagamento->descricao }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a class="btn btn-primary btn-sm" href="{{ route('formas-pagamento.edit', $formaPagamento) }}" aria-label="Editar {{ $formaPagamento->descricao }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form method="POST" action="{{ route('formas-pagamento.destroy', $formaPagamento) }}" onsubmit="return confirm('Deseja excluir esta forma de pagamento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit" aria-label="Excluir {{ $formaPagamento->descricao }}">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Nenhuma forma de pagamento cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $formasPagamento->links() }}
    </div>
@endsection

