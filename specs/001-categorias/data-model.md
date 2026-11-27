# Modelo de dados: Categorias

## `categoria`

| Campo | Tipo | Regra |
|---|---|---|
| `id` | bigint | PK incremental |
| `descricao` | varchar(255) | obrigatório, índice para ordenação |
| `margem_lucro` | decimal(7,2) | percentual não negativo, até 99999,99% tecnicamente; validação do formulário limita a 999,99% |
| `created_at`, `updated_at` | timestamp | padrão Laravel |

## Contrato com a Spec 002

`produto.categoria_id` → `categoria.id` (FK obrigatória com exclusão restrita); `produto.valor_compra` e `produto.valor_venda` são decimais com duas casas. A categoria tem muitos produtos. Categoria não cria tabela de produto nesta feature.

## Cálculo

Transformar custo em centavos e margem em pontos base. `preco_centavos = arredondar_meio_para_cima(custo_centavos × (10000 + margem_em_centésimos) / 10000)`. Devolver string monetária com duas casas.

## Estados

Criação: sem produtos. Edição de descrição: preços inalterados. Edição de margem: todos os produtos da categoria recalculados na transação. Exclusão: permitida apenas sem produtos.
