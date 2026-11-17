# Roadmap geral de Specs e Sprints

## Divisão atualizada

| Integrante | Sprint 1 | Sprint 2 | Sprint 3 |
|---|---|---|---|
| Integrante 1 | 009 Autenticação + 001 Categorias | 005 Compras | revisão |
| Integrante 2 | 002 Produtos | 006 Atualização do Produto após Compra | 010 Clientes |
| Integrante 3 | 003 Fornecedores | 007 Contas a Pagar | 011 Vendas e E-mail |
| Integrante 4 | 004 Formas de Pagamento | 008 Entrada no Estoque | 012 Contas a Receber e Relatório |

Guias:
- [Integrante 1](INTEGRANTE-1-SPECS-001-005-009.md)
- [Integrante 2](INTEGRANTE-2-SPECS-002-006-010.md)
- [Integrante 3](INTEGRANTE-3-SPECS-003-007-011.md)
- [Integrante 4](INTEGRANTE-4-SPECS-004-008-012.md)

## Sprint 1 — Fundação e cadastros

- 009 Autenticação com Breeze — Integrante 1;
- 001 Categorias — Integrante 1;
- 002 Produtos — Integrante 2;
- 003 Fornecedores — Integrante 3;
- 004 Formas de Pagamento — Integrante 4.

009 deve entrar cedo porque autenticação é requisito global. Todas as listagens usam paginação 10 e formulários usam validação. A Spec 002 atenderá o requisito mínimo de upload.

## Sprint 2 — Compra

- 005 Compras — Integrante 1;
- 006 Atualização do Produto após Compra — Integrante 2;
- 007 Contas a Pagar — Integrante 3;
- 008 Entrada no Estoque — Integrante 4.

Ao salvar compra, coordenar custo, estoque e geração de contas a pagar. 007 inclui `situacao` e baixa.

## Sprint 3 — Venda

- 010 Clientes — Integrante 2;
- 011 Vendas e E-mail — Integrante 3;
- 012 Contas a Receber e Relatório — Integrante 4.

011 inclui atualização de estoque, geração de contas a receber e e-mail. 012 inclui baixa e relatório por período da data da venda.

## Sprint 4 — Convergência

Revisão cruzada:
- 1 revisa 2;
- 2 revisa 3;
- 3 revisa 4;
- 4 revisa 1.

## Branches reservadas

```text
feature/001-categorias
feature/002-produtos
feature/003-fornecedores
feature/004-formas-pagamento
feature/005-compras
feature/006-atualizacao-produto-compra
feature/007-contas-pagar
feature/008-entrada-estoque
feature/009-autenticacao
feature/010-clientes
feature/011-vendas
feature/012-contas-receber
```

Cada diretório de Spec usa `specs/XXX-nome`.

## Regras

1. uma branch por Spec;
2. não editar Spec de outro integrante;
3. sincronizar `development` antes de implementar dependências;
4. PR sempre feature → development;
5. validar testes, quickstart e converge antes do PR;
6. `.specify/feature.json` é local.

## Datas

O professor informou 07, 14 e 21 de dezembro. O documento não associa escopo específico a cada data.
