# Guia atualizado dos integrantes

## Regras comuns

```bash
git checkout development
git pull origin development
git status
```

Fluxo Codex:

```text
$speckit-specify → $speckit-clarify → $speckit-plan → $speckit-checklist
→ $speckit-tasks → $speckit-analyze → $speckit-implement → $speckit-converge
```

Todo formulário deve ser validado e toda listagem deve paginar 10 registros.

## Integrante 1 — 009, 001 e 005

### Sprint 1 — 009 Autenticação
Branch: `feature/009-autenticacao`; diretório: `specs/009-autenticacao`.
Usar Laravel Breeze e proteger áreas do sistema. Clarificar registro público de usuários.

### Sprint 1 — 001 Categorias
Branch: `feature/001-categorias`; diretório: `specs/001-categorias`.
CRUD, margem de lucro e recálculo do preço de todos os produtos da categoria.

### Sprint 2 — 005 Compras
Branch: `feature/005-compras`; diretório: `specs/005-compras`.
Coordenar 006, 007 e 008 após salvar a compra.

## Integrante 2 — 002, 006 e 010

### Sprint 1 — 002 Produtos
Branch: `feature/002-produtos`; diretório: `specs/002-produtos`.
Campos do professor, relação com categoria, validação/paginação e upload de arquivo alocado a esta Spec.

### Sprint 2 — 006 Atualização do Produto após Compra
Branch: `feature/006-atualizacao-produto-compra`; diretório: `specs/006-atualizacao-produto-compra`.
Atualizar `valor_compra` conforme a compra e manter `valor_venda` coerente com a margem. Não usar a antiga média aritmética.

### Sprint 3 — 010 Clientes
Branch: `feature/010-clientes`; diretório: `specs/010-clientes`.
CRUD de cliente com nome, documento, email, endereço e telefone.

## Integrante 3 — 003, 007 e 011

### Sprint 1 — 003 Fornecedores
Branch: `feature/003-fornecedores`; diretório: `specs/003-fornecedores`.
CRUD com validação e paginação 10.

### Sprint 2 — 007 Contas a Pagar
Branch: `feature/007-contas-pagar`; diretório: `specs/007-contas-pagar`.
Geradas após salvar compra conforme parcelamento, com `situacao` e baixa.

### Sprint 3 — 011 Vendas e E-mail
Branch: `feature/011-vendas`; diretório: `specs/011-vendas`.
Atualizar estoque, gerar contas a receber e enviar e-mail ao cliente com dados da venda.

## Integrante 4 — 004, 008 e 012

### Sprint 1 — 004 Formas de Pagamento
Branch: `feature/004-formas-pagamento`; diretório: `specs/004-formas-pagamento`.
Clarificar `dia`, quantidade de itens e total das porcentagens.

### Sprint 2 — 008 Entrada no Estoque
Branch: `feature/008-entrada-estoque`; diretório: `specs/008-entrada-estoque`.
Regra confirmada: compra atualiza quantidade em estoque.

### Sprint 3 — 012 Contas a Receber e Relatório
Branch: `feature/012-contas-receber`; diretório: `specs/012-contas-receber`.
Baixa e relatório por período da data da venda, totalizando não pagos vencidos, não pagos a vencer e pagos.

## Ordem recomendada

Sprint 1: integrar 009 cedo; depois 001, 003, 004 e 002 após 001.
Sprint 2: 005 coordena os efeitos com 006, 007 e 008.
Sprint 3: integrar 010 antes de 011 e 012.
