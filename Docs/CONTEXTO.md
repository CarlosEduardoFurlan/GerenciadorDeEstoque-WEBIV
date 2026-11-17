# Contexto do projeto — Sistema de Compras e Vendas

Atualizado em **2026-11-17** conforme o detalhamento mais recente do professor.

## 1. Fonte vigente e entregas

O material vigente contém **DE COMPRA**, **DE VENDA** e requisitos transversais. As datas informadas para entrega são **07, 14 e 21 de dezembro**. O documento não associa explicitamente um escopo diferente a cada data.

Prioridade: requisitos do professor → Constitution → Specs → Plans → Tasks.

## 2. Stack obrigatória

| Camada | Definição |
|---|---|
| Backend | PHP 8.3+ / Laravel 13 |
| Banco | **SQLite** |
| Interface | Blade + Bootstrap 5 |
| Assets | Vite |
| Autenticação | **Laravel Breeze** |
| Arquitetura | MVC, Eloquent, migrations, Form Requests e Services quando necessários |

A decisão anterior por PostgreSQL foi substituída por SQLite.

## 3. DE COMPRA

### Categoria
`id`, `descricao`, `margem_lucro`.

Ao alterar a margem, atualizar o preço de venda de todos os produtos da categoria.

### Produto
`id`, `descricao`, `valor_compra`, `valor_venda`, `categoria`, `quantidade_estoque`.

O valor de venda corresponde à margem da categoria.

### Fornecedor
`id`, `nome`, `documento`, `email`, `endereco`, `telefone`.

### Forma de pagamento
`id`, `descricao`, `numero_parcelas`.

Itens: `porcentagem`, `dia` inteiro.

### Compra
`id`, `documento`, `fornecedor`, `data`, `forma_pagamento`, `valor`.

Itens: `produto`, `quantidade`, `valor_unitario`, `valor_total`.

Ao salvar:
- atualizar `valor_compra` do produto conforme a compra;
- atualizar quantidade em estoque;
- gerar contas a pagar conforme o parcelamento.

A antiga exigência de média aritmética não aparece no detalhamento atual e deixa de ser requisito ativo.

### Contas a pagar
`id`, `documento`, `fornecedor`, `compra`, `data_vencimento`, `valor`, `data_pagamento`, `situacao`.

Deve existir baixa de contas a pagar.

## 4. DE VENDA

### Cliente
`id`, `nome`, `documento`, `email`, `endereco`, `telefone`.

### Venda
`id`, `documento`, `cliente`, `data`, `forma_pagamento`, `valor`.

Itens: `produto`, `quantidade`, `valor_unitario`, `valor_total`.

A venda:
- atualiza estoque;
- gera contas a receber conforme parcelamento;
- envia e-mail ao cliente com os dados da venda.

### Contas a receber
`id`, `documento`, `cliente`, `venda`, `data_vencimento`, `valor`, `data_pagamento`.

Deve existir baixa.

Relatório por período conforme **data da venda**, totalizando:
- não pagos vencidos;
- não pagos a vencer;
- pagos.

## 5. Requisitos transversais

- SQLite;
- pelo menos um cadastro com upload de arquivo;
- validação de formulários;
- paginação de 10 em 10;
- autenticação com Breeze;
- e-mail em cada venda;
- relatório de contas a receber.

Para distribuir responsabilidade, o roadmap aloca o upload à **Spec 002 — Produtos**. Isso é uma decisão interna do grupo para satisfazer o requisito mínimo.

## 6. Clarificações restantes

1. significado exato de `dia`;
2. quantidade de itens versus `numero_parcelas`;
3. soma das porcentagens deve ser 100%;
4. regra exata para atualizar `valor_compra` numa nova compra;
5. valores/transições de `situacao` de contas a pagar;
6. comportamento quando a venda solicita quantidade maior que o estoque;
7. tipo/tamanho/formato do arquivo do upload;
8. Breeze: cadastro público de usuários ou apenas usuários previamente cadastrados.

## 7. Specs

Existentes/reservadas: 001 Categorias, 002 Produtos, 003 Fornecedores, 004 Formas de Pagamento, 005 Compras, 006 Atualização do Produto após Compra, 007 Contas a Pagar, 008 Entrada no Estoque.

Novas: 009 Autenticação, 010 Clientes, 011 Vendas e E-mail, 012 Contas a Receber e Relatório.

## 8. Fluxo

```text
Requisito → Spec → Clarify → Plan → Checklist → Tasks → Analyze → Implement → Converge
```

Branches partem de `development` e retornam para `development` por PR.
