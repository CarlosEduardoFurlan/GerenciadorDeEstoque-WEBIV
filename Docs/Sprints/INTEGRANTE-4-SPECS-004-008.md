# Integrante 4 — Specs 004 e 008

Guia de responsabilidade ligado ao [roadmap geral](README.md) e ao
[contexto do projeto](../CONTEXTO.md). Os diretórios e branches abaixo são reservas para
trabalho futuro: nenhuma Spec é criada por este documento. As tarefas executáveis serão
geradas em `specs/<numero>-<feature>/tasks.md`; não duplicá-las neste guia.

## Spec 004 — Formas de Pagamento

**Responsável:** Integrante 4. **Sprint:** 1.

**Diretório reservado:** `specs/004-formas-pagamento`.

**Branch:** `feature/004-formas-pagamento`.

**Escopo conhecido:**

- descrição;
- número de parcelas;
- itens;
- porcentagem;
- `dia` inteiro.

**Dependências:** Nenhuma dependência prévia de negócio indicada; alinhar as regras compartilhadas com os fluxos futuros de compra e contas a pagar.

**Pontos de clarificação:**

- Qual é o significado de `dia`?
- Qual é a relação entre `numero_parcelas` e a quantidade de itens?
- A soma das porcentagens deve ser exatamente 100%?

**Clarify obrigatório** para os três pontos. Coordenar as decisões futuras com `005-compras` e `007-contas-pagar`. O relacionamento técnico dos itens com a forma de pagamento pertence ao Plan/Data Model, sem decisão antecipada neste guia.

**Fluxo que o integrante executará futuramente:**

Partir da `development` atualizada e criar uma branch exclusiva para esta Spec:

```bash
git checkout development
git pull origin development
git checkout -b feature/004-formas-pagamento
```

Depois, no chat do Codex, informar o diretório explicitamente e descrever o escopo:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/004-formas-pagamento
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

## Spec 008 — Entrada no Estoque

**Responsável:** Integrante 4. **Sprint:** 2.

**Diretório reservado:** `specs/008-entrada-estoque`.

**Branch:** `feature/008-entrada-estoque`.

**Escopo conhecido:**


- escopo provável: atualizar `quantidade_estoque` a partir de uma compra.

**Dependências:** `002-produtos` e `005-compras`. A implementação exige a integração das dependências necessárias em `development` e a confirmação da própria regra.

**Pontos de clarificação:**

- A compra realmente aumenta o estoque automaticamente?
- Em qual momento ocorre essa atualização?
- Existe algum conceito de finalização/confirmação da compra?

**Clarificação obrigatória antes da implementação.** A folha recebida mostra estoque no produto, mas não confirma diretamente a automação nem seu momento. Coordenar com `002-produtos` e `005-compras`. Não criar entidade de movimentação de estoque sem novo requisito.

**Fluxo que o integrante executará futuramente:**

Partir da `development` atualizada e criar uma branch exclusiva para esta Spec:

```bash
git checkout development
git pull origin development
git checkout -b feature/008-entrada-estoque
```

Depois, no chat do Codex, informar o diretório explicitamente e descrever o escopo:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/008-entrada-estoque
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
