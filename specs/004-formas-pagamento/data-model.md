# Data Model: Formas de Pagamento

## FormaPagamento

Representa uma condição de pagamento cadastrada.

| Campo | Tipo lógico | Regras |
|---|---|---|
| `id` | identificador inteiro | chave primária autogerada |
| `descricao` | texto | obrigatório; até 255 caracteres; não há unicidade inventada |
| `numero_parcelas` | inteiro | obrigatório; mínimo 1 |
| `created_at` | data/hora | controle técnico do cadastro |
| `updated_at` | data/hora | controle técnico da alteração |

**Relacionamento**: possui muitos `ItemFormaPagamento`. A quantidade de itens deve ser exatamente igual a `numero_parcelas`.

## ItemFormaPagamento

Representa uma parcela da forma de pagamento.

| Campo | Tipo lógico | Regras |
|---|---|---|
| `id` | identificador inteiro | chave primária autogerada |
| `forma_pagamento_id` | identificador inteiro | FK obrigatória para `forma_pagamento.id`, indexada; exclusão em cascata |
| `porcentagem` | decimal (5,2) | obrigatório; entre 0 e 100; a soma da coleção deve ser exatamente 100 |
| `dia` | inteiro | obrigatório; mínimo 0; quantidade de dias após a compra ou venda |
| `created_at` | data/hora | controle técnico do cadastro |
| `updated_at` | data/hora | controle técnico da alteração |

## Invariantes do agregado

1. Uma forma tem pelo menos uma parcela e pelo menos um item.
2. Cada item pertence a exatamente uma forma.
3. A quantidade de itens é igual ao número de parcelas.
4. A soma das porcentagens, calculada em centésimos, é exatamente 100,00%.
5. Cadastro e alteração da forma e dos itens são atômicos.
6. A exclusão da forma remove seus itens dependentes.

## Transições

- **Criar**: validar o agregado completo e persistir forma e itens na mesma operação.
- **Alterar**: validar o agregado completo, atualizar a forma e substituir os itens na mesma operação.
- **Excluir**: remover a forma; seus itens são removidos pela relação de dependência.
- **Consultar**: carregar a forma e seus itens ordenados por `dia` e identificador.

