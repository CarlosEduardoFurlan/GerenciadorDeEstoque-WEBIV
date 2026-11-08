# Guia de trabalho dos integrantes — Specs e Sprints

Este documento é o guia operacional do grupo para o desenvolvimento do **Sistema de Compras e Vendas** com GitHub Spec Kit.

As regras gerais continuam em [Docs/Sprints/README.md](Sprints/README.md), a governança está em [/.specify/memory/constitution.md](../.specify/memory/constitution.md) e o contexto atual do projeto está em [Docs/CONTEXTO.md](CONTEXTO.md).

Este arquivo **não substitui** as Specs nem o `tasks.md` de cada feature. Ele serve para o grupo saber **quem faz o quê, em qual Sprint, qual branch usar, quais dependências respeitar e em que momento sincronizar**.

---

## 1. Fluxo Git oficial

Todas as features partem da `development` e retornam para `development` por Pull Request:

```text
feature/XXX-nome
        ↓
   development
        ↓
      main
```

- `development`: integração do trabalho do grupo.
- `main`: versão estável/consolidada.
- Nunca abrir PR de uma feature diretamente para `main`.
- Cada Spec deve ter sua própria branch.
- Não desenvolver duas Specs na mesma branch.

Antes de iniciar qualquer Spec:

```bash
git checkout development
git pull origin development
git status
```

O `git status` deve estar limpo.

Depois verificar o ambiente:

```bash
specify --version
specify integration status
php artisan test
```

---

## 2. Fluxo Spec Kit que todos devem seguir

Para cada Spec, executar no Codex uma etapa por vez:

```text
$speckit-specify
        ↓
$speckit-clarify
        ↓
$speckit-plan
        ↓
$speckit-checklist
        ↓
$speckit-tasks
        ↓
$speckit-analyze
        ↓
$speckit-implement
        ↓
$speckit-converge
```

Regras:

1. Ler e revisar o resultado de cada etapa antes de avançar.
2. Não inventar respostas para dúvidas que dependem do professor.
3. Não executar `$speckit-implement` com clarificações críticas abertas.
4. Não implementar enquanto `$speckit-analyze` apontar inconsistências críticas.
5. Executar `$speckit-converge` antes de abrir o PR.
6. Se o converge criar trabalho restante, repetir:
   ```text
   $speckit-implement
   $speckit-converge
   ```
   até obter `Converged`.
7. Antes do PR:
   ```bash
   php artisan test
   ```
   e executar também os cenários do `quickstart.md` da própria Spec.

---

## 3. Divisão geral

| Integrante | Sprint 1 | Sprint 2 |
|---|---|---|
| Integrante 1 | Spec 001 — Categorias | Spec 005 — Compras |
| Integrante 2 | Spec 002 — Produtos | Spec 006 — Atualização de Custos e Preço de Venda |
| Integrante 3 | Spec 003 — Fornecedores | Spec 007 — Contas a Pagar |
| Integrante 4 | Spec 004 — Formas de Pagamento | Spec 008 — Entrada no Estoque |

A **Sprint 1 deve ser integrada e estabilizada antes da implementação da Sprint 2**.

A Sprint 3, referente a vendas, continua bloqueada até o professor fornecer os requisitos atualizados.

---

# 4. Integrante 1

## Sprint 1 — Spec 001: Categorias

**Branch:**

```text
feature/001-categorias
```

**Diretório reservado:**

```text
specs/001-categorias
```

**Escopo conhecido:**

- descrição;
- margem de lucro;
- CRUD;
- validações;
- participação da margem na formação do valor de venda dos produtos.

**Dependências:** nenhuma feature de negócio anterior.

**Clarificação compartilhada:**

- quando a margem da categoria mudar, produtos já existentes devem ter o valor de venda recalculado?

Essa decisão deve ser coordenada com:

- Spec 002 — Produtos;
- Spec 006 — Atualização de Custos.

### Passos

```bash
git checkout development
git pull origin development
git checkout -b feature/001-categorias
```

No Codex, iniciar com:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/001-categorias
```

Depois seguir o fluxo completo do Spec Kit.

### Checkpoint

A Spec 001 pode ser implementada sem depender de outra feature de negócio. Quando estiver convergida e testada, abrir PR:

```text
feature/001-categorias → development
```

Ela deve ser a primeira integração da Sprint 1 porque Produto depende de Categoria.

---

## Sprint 2 — Spec 005: Compras

**Branch:**

```text
feature/005-compras
```

**Diretório reservado:**

```text
specs/005-compras
```

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
- cálculo dos valores dos itens e do total.

**Dependências:**

- Spec 002 — Produtos;
- Spec 003 — Fornecedores;
- Spec 004 — Formas de Pagamento.

**Integrações que devem ser coordenadas depois:**

- Spec 006 — atualização de custos;
- Spec 007 — contas a pagar;
- Spec 008 — entrada no estoque.

Não presumir status, confirmação ou automações herdadas do modelo antigo.

### Quando começar

A especificação e o estudo podem começar antes, mas a **implementação da Spec 005 só deve avançar quando as dependências necessárias da Sprint 1 estiverem integradas em `development`**.

Antes de implementar:

```bash
git checkout development
git pull origin development
git checkout feature/005-compras
git merge development
```

---

# 5. Integrante 2

## Sprint 1 — Spec 002: Produtos

**Branch:**

```text
feature/002-produtos
```

**Diretório reservado:**

```text
specs/002-produtos
```

**Escopo conhecido:**

- descrição;
- valor de compra;
- valor de venda;
- categoria;
- quantidade em estoque;
- valor de venda relacionado à margem da categoria.

**Dependência conceitual:**

- Spec 001 — Categorias.

Não reincorporar automaticamente:

- código de barras;
- embalagem;
- estoque mínimo;
- estoque máximo;
- campo ativo.

**Clarificações compartilhadas:**

- em quais eventos o valor de venda é recalculado?
- como a mudança da margem de uma categoria afeta produtos existentes?

Coordenar essas decisões com:

- Spec 001 — Categorias;
- Spec 006 — Atualização de Custos.

### Passos

```bash
git checkout development
git pull origin development
git checkout -b feature/002-produtos
```

No Codex:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/002-produtos
```

O Integrante 2 pode executar `specify`, `clarify`, `plan`, `checklist`, `tasks` e `analyze` em paralelo com a Spec 001.

### Antes de implementar código dependente de Categoria

Aguardar a Spec 001 entrar em `development` e sincronizar:

```bash
git checkout development
git pull origin development
git checkout feature/002-produtos
git merge development
```

Depois continuar com implementação, testes e converge.

---

## Sprint 2 — Spec 006: Atualização de Custos e Preço de Venda

**Branch:**

```text
feature/006-atualizacao-custos
```

**Diretório reservado:**

```text
specs/006-atualizacao-custos
```

**Escopo conhecido:**

- atualização de `valor_compra`;
- média aritmética conforme requisito do professor;
- atualização de `valor_venda` conforme margem da categoria.

**Dependências:**

- Spec 001 — Categorias;
- Spec 002 — Produtos;
- Spec 005 — Compras.

**Clarificações obrigatórias:**

- fórmula exata da média aritmética;
- quais valores participam da média;
- em qual momento o recálculo ocorre.

**Não implementar nenhuma fórmula enquanto essas respostas não estiverem confirmadas.**

---

# 6. Integrante 3

## Sprint 1 — Spec 003: Fornecedores

**Branch:**

```text
feature/003-fornecedores
```

**Diretório reservado:**

```text
specs/003-fornecedores
```

**Escopo conhecido:**

- nome;
- documento;
- email;
- endereço;
- telefone;
- CRUD;
- validações.

**Dependências:** relativamente independente.

Não assumir que `documento` significa exclusivamente CNPJ.

Se formato, obrigatoriedade ou unicidade não estiverem definidos, tratar na Spec/Clarify sem inventar a regra.

### Passos

```bash
git checkout development
git pull origin development
git checkout -b feature/003-fornecedores
```

No Codex:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/003-fornecedores
```

Por ser relativamente independente, esta feature pode avançar pelo fluxo completo em paralelo com as demais.

PR final:

```text
feature/003-fornecedores → development
```

---

## Sprint 2 — Spec 007: Contas a Pagar

**Branch:**

```text
feature/007-contas-pagar
```

**Diretório reservado:**

```text
specs/007-contas-pagar
```

**Escopo conhecido:**

- documento;
- fornecedor;
- compra;
- data de vencimento;
- valor;
- data de pagamento.

**Dependências:**

- Spec 003 — Fornecedores;
- Spec 004 — Formas de Pagamento;
- Spec 005 — Compras.

**Clarificações obrigatórias:**

- contas são geradas automaticamente?
- qual a relação das parcelas da forma de pagamento com as contas?
- como os vencimentos são calculados?
- qual a relação entre `dia` e `data_vencimento`?
- em qual momento as contas são criadas?

Não presumir que `data_vencimento = compra.data + dia` sem confirmação.

---

# 7. Integrante 4

## Sprint 1 — Spec 004: Formas de Pagamento

**Branch:**

```text
feature/004-formas-pagamento
```

**Diretório reservado:**

```text
specs/004-formas-pagamento
```

**Escopo conhecido:**

- descrição;
- número de parcelas;
- itens;
- porcentagem;
- dia inteiro.

**Clarificações obrigatórias:**

1. o que significa o campo `dia`?
2. a quantidade de itens deve ser exatamente igual ao número de parcelas?
3. a soma das porcentagens deve ser exatamente 100%?

Coordenar as decisões futuras com:

- Spec 005 — Compras;
- Spec 007 — Contas a Pagar.

### Passos

```bash
git checkout development
git pull origin development
git checkout -b feature/004-formas-pagamento
```

No Codex:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/004-formas-pagamento
```

### Checkpoint

Se as três dúvidas ainda não tiverem resposta do professor, **não avançar para implementação assumindo respostas por conveniência**. A Spec pode registrar a pendência até a decisão ser confirmada.

---

## Sprint 2 — Spec 008: Entrada no Estoque

**Branch:**

```text
feature/008-entrada-estoque
```

**Diretório reservado:**

```text
specs/008-entrada-estoque
```

**Escopo provável:**

- atualizar `quantidade_estoque` a partir de uma compra.

**Dependências:**

- Spec 002 — Produtos;
- Spec 005 — Compras.

**Clarificações obrigatórias:**

- a compra aumenta o estoque automaticamente?
- em qual momento isso acontece?
- existe conceito de finalização/confirmação da compra?

Não criar uma entidade de movimentação de estoque sem novo requisito do professor.

---

# 8. Ordem de integração da Sprint 1

A recomendação é:

```text
001-categorias
      ↓
003-fornecedores
      ↓
004-formas-pagamento
      ↓
002-produtos
```

Motivo:

- Categoria é dependência direta de Produto.
- Fornecedor é independente.
- Forma de Pagamento é independente na Sprint 1, embora tenha impacto futuro.
- Produto deve integrar depois de Categoria.

Isso **não impede** que todos façam especificação e planejamento em paralelo.

---

# 9. Como evitar conflitos

## Não editar a Spec de outro integrante

Cada integrante trabalha somente em seus próprios diretórios `specs/XXX-...`.

Se uma decisão afetar outra feature:

1. avisar o responsável;
2. alinhar a decisão;
3. registrar a decisão nas Specs afetadas;
4. cada responsável altera sua própria Spec.

## Arquivos compartilhados

Evitar mudanças simultâneas sem coordenação em:

```text
routes/web.php
database/seeders/DatabaseSeeder.php
README.md
Docs/CONTEXTO.md
Docs/Sprints/README.md
```

## Sincronização

Quando uma dependência entrar em `development`, a feature dependente deve sincronizar:

```bash
git checkout development
git pull origin development
git checkout feature/XXX-nome
git merge development
```

Para este projeto, usar **merge da `development` para a feature**, evitando alternar entre merge e rebase.

## Estado local do Spec Kit

`.specify/feature.json` é local e não deve ser usado para coordenar o grupo.

Cada integrante deve conferir se o Spec Kit está apontando para a sua própria feature antes de rodar comandos.

---

# 10. Checkpoint atual do grupo

Neste momento, cada integrante deve executar apenas sua **Spec da Sprint 1**:

```text
Integrante 1 → 001-categorias
Integrante 2 → 002-produtos
Integrante 3 → 003-fornecedores
Integrante 4 → 004-formas-pagamento
```

Primeiro checkpoint recomendado para os quatro:

```text
$speckit-specify
        ↓
$speckit-clarify
        ↓
REVISÃO DO GRUPO
```

Antes de avançar para implementação, revisar principalmente:

- Specs 001 e 002: regra de margem e preço de venda;
- Spec 004: significado de `dia`, número de parcelas e porcentagens;
- possíveis decisões que afetarão 005, 006 e 007.

Depois dessa revisão, cada integrante continua com:

```text
plan → checklist → tasks → analyze → implement → converge
```

---

# 11. Sprint 2

A Sprint 2 começa depois que a base necessária da Sprint 1 estiver integrada em `development`.

```text
Integrante 1 → 005-compras
Integrante 2 → 006-atualizacao-custos
Integrante 3 → 007-contas-pagar
Integrante 4 → 008-entrada-estoque
```

As Specs da Sprint 2 têm mais dependências entre si. Por isso, **não implementar efeitos de compra, custo, estoque ou financeiro isoladamente sem alinhar as decisões compartilhadas**.

---

# 12. Sprint 3 e Sprint 4

## Sprint 3 — Vendas

```text
BLOQUEADA — AGUARDANDO REQUISITOS ATUALIZADOS DO PROFESSOR
```

Não criar Specs 009+ enquanto os requisitos não forem recebidos.

## Sprint 4 — Convergência e revisão cruzada

Responsabilidades:

| Integrante | Specs para revisão final |
|---|---|
| Integrante 1 | 001 e 005 |
| Integrante 2 | 002 e 006 |
| Integrante 3 | 003 e 007 |
| Integrante 4 | 004 e 008 |

Revisão cruzada:

- Integrante 1 revisa Integrante 2;
- Integrante 2 revisa Integrante 3;
- Integrante 3 revisa Integrante 4;
- Integrante 4 revisa Integrante 1.

Uma feature só é considerada concluída depois de requisitos revisados, testes executados, quickstart validado e `$speckit-converge` retornar `Converged`.
