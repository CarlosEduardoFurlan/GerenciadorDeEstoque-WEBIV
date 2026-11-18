@extends('template')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Listagem de Fornecedores</h1>
        <a class="btn btn-primary" href="{{ url('fornecedor/novo') }}">Novo Fornecedor</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>E-mail</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fornecedores as $fornecedor)
                    <tr>
                        <td>{{ $fornecedor->id }}</td>
                        <td>{{ $fornecedor->nome }}</td>
                        <td>{{ $fornecedor->documento }}</td>
                        <td>{{ $fornecedor->email }}</td>
                        <td>{{ $fornecedor->endereco }}</td>
                        <td>{{ $fornecedor->telefone }}</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm" href='{{ url("fornecedor/editar/$fornecedor->id") }}' aria-label="Editar {{ $fornecedor->nome }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-danger btn-sm" href='{{ url("fornecedor/excluir/$fornecedor->id") }}' aria-label="Excluir {{ $fornecedor->nome }}">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Nenhum fornecedor cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $fornecedores->links() }}
    </div>
@endsection
