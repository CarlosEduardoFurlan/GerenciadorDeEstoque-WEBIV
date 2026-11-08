# Integrante 1 — Specs 001 e 005

Guia de responsabilidade ligado ao [roadmap geral](README.md) e ao
[contexto do projeto](../CONTEXTO.md). Os diretórios e branches abaixo são reservas para
trabalho futuro: nenhuma Spec é criada por este documento. As tarefas executáveis serão
geradas em `specs/<numero>-<feature>/tasks.md`; não duplicá-las neste guia.

## Spec 001 — Categorias

**Responsável:** Integrante 1. **Sprint:** 1.

**Diretório reservado:** `specs/001-categorias`.

**Branch:** `feature/001-categorias`.

**Escopo conhecido:**

- descrição;
- margem de lucro;
- CRUD;
- validações;
- participação da margem na formação do valor de venda dos produtos.

**Dependências:** Nenhuma feature de negócio anterior.

**Pontos de clarificação:**

- Quando a margem da categoria mudar, produtos já existentes devem ter o valor de venda recalculado?

Coordenar a resposta com `002-produtos` e `006-atualizacao-custos`, antes de definir seus gatilhos e efeitos.

**Fluxo que o integrante executará futuramente:**

Partir da `development` atualizada e criar uma branch exclusiva para esta Spec:

```bash
git checkout development
git pull origin development
git checkout -b feature/001-categorias
```

Depois, no chat do Codex, informar o diretório explicitamente e descrever o escopo:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/001-categorias
```

Não depender da numeração automática. Conferir o diretório resolvido e o contexto ativo;
na sequência, executar uma etapa por vez, revisando cada resultado:

```text
$speckit-clarify
$speckit-plan
$speckit-checklist
$speckit-tasks
$speckit-analyze
$speckit-implement
$speckit-converge
```

`implement` só pode começar com clarificações críticas resolvidas, checklist adequado,
Spec/Plan/Tasks consistentes e dependências necessárias disponíveis. Aplicar as regras
de sincronização, testes, convergência e PR para `development` do [roadmap](README.md).
Os comandos acima são documentação futura; **não criar esta Spec agora**.

## Spec 005 — Compras

**Responsável:** Integrante 1. **Sprint:** 2.

**Diretório reservado:** `specs/005-compras`.

**Branch:** `feature/005-compras`.

**Escopo conhecido:**

- documento;
- fornecedor;
- data;
- forma de pagamento;
- valor;
- itens;
- produto;
- quantidade;
- valor unitário;
- valor total;
- cálculo de subtotal e total.

**Dependências:** `002-produtos`, `003-fornecedores` e `004-formas-pagamento`. Esta Spec pertence à Sprint 2 e não deve começar sua implementação antes da integração das dependências necessárias na `development`.

**Pontos de clarificação:**

- Quais efeitos da compra serão compartilhados com as Specs 006, 007 e 008, e em qual momento eles ocorrerão?

Coordenar seus efeitos com `006-atualizacao-custos`, `007-contas-pagar` e `008-entrada-estoque`. Não presumir status, confirmação, movimentação ou regras herdadas do modelo anterior. As respostas sobre custo, estoque e contas a pagar continuam pendentes de Clarify/professor.

**Fluxo que o integrante executará futuramente:**

Partir da `development` atualizada e criar uma branch exclusiva para esta Spec:

```bash
git checkout development
git pull origin development
git checkout -b feature/005-compras
```

Depois, no chat do Codex, informar o diretório explicitamente e descrever o escopo:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/005-compras
```

Não depender da numeração automática. Conferir o diretório resolvido e o contexto ativo;
na sequência, executar uma etapa por vez, revisando cada resultado:

```text
$speckit-clarify
$speckit-plan
$speckit-checklist
$speckit-tasks
$speckit-analyze
$speckit-implement
$speckit-converge
```

`implement` só pode começar com clarificações críticas resolvidas, checklist adequado,
Spec/Plan/Tasks consistentes e dependências necessárias disponíveis. Aplicar as regras
de sincronização, testes, convergência e PR para `development` do [roadmap](README.md).
Os comandos acima são documentação futura; **não criar esta Spec agora**.
