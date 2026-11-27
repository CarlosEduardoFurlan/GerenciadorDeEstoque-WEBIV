@extends('template')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Categorias</h1>
        <a class="btn btn-primary" href="{{ route('categorias.create') }}">Nova categoria</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead><tr><th>Descrição</th><th>Margem de lucro</th><th>Ações</th></tr></thead>
            <tbody>
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->descricao }}</td>
                        <td>{{ number_format((float) $categoria->margem_lucro, 2, ',', '.') }}%</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('categorias.edit', $categoria) }}">Editar</a>
                                <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('Excluir esta categoria?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">Nenhuma categoria cadastrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $categorias->links('pagination::bootstrap-5') }}
@endsection
