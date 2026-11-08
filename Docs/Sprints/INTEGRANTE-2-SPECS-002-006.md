# Integrante 2 — Specs 002 e 006

Guia de responsabilidade ligado ao [roadmap geral](README.md) e ao
[contexto do projeto](../CONTEXTO.md). Os diretórios e branches abaixo são reservas para
trabalho futuro: nenhuma Spec é criada por este documento. As tarefas executáveis serão
geradas em `specs/<numero>-<feature>/tasks.md`; não duplicá-las neste guia.

## Spec 002 — Produtos

**Responsável:** Integrante 2. **Sprint:** 1.

**Diretório reservado:** `specs/002-produtos`.

**Branch:** `feature/002-produtos`.

**Escopo conhecido:**

- descrição;
- valor de compra;
- valor de venda;
- categoria;
- quantidade em estoque;
- valor de venda conforme a margem da categoria.

**Dependências:** Dependência conceitual: `001-categorias`.

**Pontos de clarificação:**

- Em quais eventos `valor_venda` é recalculado?
- Como mudanças na margem da categoria afetam os produtos existentes?

Coordenar decisões com `001-categorias` e `006-atualizacao-custos`. Não recuperar automaticamente código de barras, embalagem, estoque mínimo, estoque máximo ou campo `ativo`. O integrante pode executar Specify, Clarify e Plan em paralelo com a Spec 001. Antes da implementação final que dependa de Categoria, sincronizar a branch com `development` depois da integração da 001, conforme a estratégia de merge do roadmap.

**Fluxo que o integrante executará futuramente:**

Partir da `development` atualizada e criar uma branch exclusiva para esta Spec:

```bash
git checkout development
git pull origin development
git checkout -b feature/002-produtos
```

Depois, no chat do Codex, informar o diretório explicitamente e descrever o escopo:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/002-produtos
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

## Spec 006 — Atualização de Custos e Preço de Venda

**Responsável:** Integrante 2. **Sprint:** 2.

**Diretório reservado:** `specs/006-atualizacao-custos`.

**Branch:** `feature/006-atualizacao-custos`.

**Escopo conhecido:**

- atualização de `valor_compra`;
- média aritmética conforme a regra do professor;
- atualização de `valor_venda` conforme a margem da categoria.

**Dependências:** `001-categorias`, `002-produtos` e `005-compras`. A implementação exige a integração das dependências necessárias em `development`.

**Pontos de clarificação:**

- Qual é a fórmula exata da média aritmética?
- Quais valores participam da média?
- Quando o recálculo ocorre?

**Clarificação obrigatória. Não assumir nenhuma fórmula antes da resposta.** Coordenar custos e gatilhos de venda com os responsáveis por `001-categorias`, `002-produtos` e `005-compras`, sem inventar eventos automáticos.

**Fluxo que o integrante executará futuramente:**

Partir da `development` atualizada e criar uma branch exclusiva para esta Spec:

```bash
git checkout development
git pull origin development
git checkout -b feature/006-atualizacao-custos
```

Depois, no chat do Codex, informar o diretório explicitamente e descrever o escopo:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/006-atualizacao-custos
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
