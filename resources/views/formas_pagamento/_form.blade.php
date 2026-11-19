@php
    $linhasItens = old('itens', $itens);
@endphp

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <p class="fw-semibold mb-2">Corrija os dados informados:</p>
        <ul class="mb-0">
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="descricao" class="form-label">Descrição</label>
    <input
        type="text"
        class="form-control @error('descricao') is-invalid @enderror"
        id="descricao"
        name="descricao"
        maxlength="255"
        value="{{ old('descricao', $formaPagamento->descricao) }}"
        required
    >
    @error('descricao')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="numero_parcelas" class="form-label">Número de parcelas</label>
    <input
        type="number"
        class="form-control @error('numero_parcelas') is-invalid @enderror"
        id="numero_parcelas"
        name="numero_parcelas"
        min="1"
        step="1"
        value="{{ old('numero_parcelas', $formaPagamento->numero_parcelas) }}"
        required
    >
    <div class="form-text">Deve existir exatamente um item para cada parcela.</div>
    @error('numero_parcelas')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex justify-content-between align-items-center mb-2">
    <h2 class="h4 mb-0">Itens da forma de pagamento</h2>
    <button type="button" class="btn btn-outline-primary btn-sm" id="adicionar-item">
        <i class="bi bi-plus-lg"></i> Adicionar item
    </button>
</div>

@error('itens')
    <div class="alert alert-danger py-2">{{ $message }}</div>
@enderror

<p class="text-muted">O dia representa a quantidade de dias após a compra ou venda. As porcentagens devem totalizar 100%.</p>

<div id="lista-itens">
    @foreach ($linhasItens as $indice => $item)
        <div class="row g-3 align-items-end border rounded p-3 mb-3 item-forma-pagamento">
            <div class="col-md-5">
                <label for="itens_{{ $indice }}_porcentagem" class="form-label">Porcentagem</label>
                <div class="input-group">
                    <input
                        type="number"
                        class="form-control @error("itens.$indice.porcentagem") is-invalid @enderror"
                        id="itens_{{ $indice }}_porcentagem"
                        name="itens[{{ $indice }}][porcentagem]"
                        min="0"
                        max="100"
                        step="0.01"
                        value="{{ $item['porcentagem'] ?? '' }}"
                        required
                    >
                    <span class="input-group-text">%</span>
                    @error("itens.$indice.porcentagem")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-5">
                <label for="itens_{{ $indice }}_dia" class="form-label">Dia</label>
                <div class="input-group">
                    <input
                        type="number"
                        class="form-control @error("itens.$indice.dia") is-invalid @enderror"
                        id="itens_{{ $indice }}_dia"
                        name="itens[{{ $indice }}][dia]"
                        min="0"
                        step="1"
                        value="{{ $item['dia'] ?? '' }}"
                        required
                    >
                    <span class="input-group-text">dias</span>
                    @error("itens.$indice.dia")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2 d-grid">
                <button type="button" class="btn btn-outline-danger remover-item">Remover</button>
            </div>
        </div>
    @endforeach
</div>

<template id="modelo-item">
    <div class="row g-3 align-items-end border rounded p-3 mb-3 item-forma-pagamento">
        <div class="col-md-5">
            <label for="itens___INDEX___porcentagem" class="form-label">Porcentagem</label>
            <div class="input-group">
                <input type="number" class="form-control" id="itens___INDEX___porcentagem" name="itens[__INDEX__][porcentagem]" min="0" max="100" step="0.01" required>
                <span class="input-group-text">%</span>
            </div>
        </div>
        <div class="col-md-5">
            <label for="itens___INDEX___dia" class="form-label">Dia</label>
            <div class="input-group">
                <input type="number" class="form-control" id="itens___INDEX___dia" name="itens[__INDEX__][dia]" min="0" step="1" required>
                <span class="input-group-text">dias</span>
            </div>
        </div>
        <div class="col-md-2 d-grid">
            <button type="button" class="btn btn-outline-danger remover-item">Remover</button>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const lista = document.getElementById('lista-itens');
        const modelo = document.getElementById('modelo-item').innerHTML;
        let proximoIndice = {{ count($linhasItens) }};

        document.getElementById('adicionar-item').addEventListener('click', () => {
            lista.insertAdjacentHTML('beforeend', modelo.replaceAll('__INDEX__', proximoIndice));
            proximoIndice += 1;
        });

        lista.addEventListener('click', (evento) => {
            if (!evento.target.classList.contains('remover-item')) {
                return;
            }

            if (lista.querySelectorAll('.item-forma-pagamento').length === 1) {
                return;
            }

            evento.target.closest('.item-forma-pagamento').remove();
        });
    });
</script>

