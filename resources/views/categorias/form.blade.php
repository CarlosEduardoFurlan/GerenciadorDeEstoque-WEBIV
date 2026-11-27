@extends('template')

@section('conteudo')
    <h1 class="h3 mb-4">{{ $categoria->exists ? 'Editar categoria' : 'Nova categoria' }}</h1>

    <form method="POST" action="{{ $categoria->exists ? route('categorias.update', $categoria) : route('categorias.store') }}">
        @csrf
        @if ($categoria->exists)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input id="descricao" name="descricao" type="text" maxlength="255" required value="{{ old('descricao', $categoria->descricao) }}" class="form-control @error('descricao') is-invalid @enderror">
            @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="margem_lucro" class="form-label">Margem de lucro (%)</label>
            <input id="margem_lucro" name="margem_lucro" type="number" min="0" max="999.99" step="0.01" required value="{{ old('margem_lucro', $categoria->margem_lucro) }}" class="form-control @error('margem_lucro') is-invalid @enderror">
            @error('margem_lucro') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <div class="form-text">O preço de venda é o valor de compra acrescido desta margem. Ao alterá-la, os preços dos produtos da categoria são atualizados.</div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
@endsection
