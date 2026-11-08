# Roadmap geral de Specs e Sprints

O **Sistema de Compras e Vendas** utiliza Spec-Driven Development com GitHub Spec Kit
e integração `codex`. A adoção já foi integrada em `development`; esta preparação é
somente documental. As Specs 001–008 estão reservadas e ainda não foram criadas.

As fontes são os requisitos atualizados do professor, a
[Constitution](../../.specify/memory/constitution.md) e o [contexto](../CONTEXTO.md).
Não existe DER definitivo enquanto houver requisitos aguardando clarificação.
Os arquivos por integrante descrevem responsabilidades, escopo conhecido e dependências;
não são Specs nem listas de tarefas executáveis.

## Modelo de desenvolvimento

Para cada feature futura, executar no chat do Codex uma etapa por vez e revisar o resultado:

```text
Requisito do professor
        ↓
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

| Artefato em `specs/<numero>-<feature>/` | Finalidade |
|---|---|
| `spec.md` | WHAT e WHY: o que entregar e por quê; critérios de aceitação, histórias quando aplicáveis e casos de erro |
| `plan.md` | HOW técnico: abordagem, dependências e validação |
| `tasks.md` | Tarefas executáveis da feature |
| `checklists/` | Qualidade dos requisitos: clareza, completude e consistência |
| `data-model.md` | Modelo de dados da feature |
| `research.md` | Decisões que exigiram pesquisa e suas justificativas |
| `quickstart.md` | Cenários de validação reproduzíveis |

**Não duplicar tarefas de `tasks.md` em `Docs/Sprints/`.** Esses artefatos serão gerados
posteriormente pelo Spec Kit; nenhum diretório `specs/` será criado nesta reorganização.

## Divisão por integrante

| Integrante | Sprint 1 | Sprint 2 |
|---|---|---|
| [Integrante 1](INTEGRANTE-1-SPECS-001-005.md) | Spec 001 — Categorias | Spec 005 — Compras |
| [Integrante 2](INTEGRANTE-2-SPECS-002-006.md) | Spec 002 — Produtos | Spec 006 — Atualização de Custos e Preço de Venda |
| [Integrante 3](INTEGRANTE-3-SPECS-003-007.md) | Spec 003 — Fornecedores | Spec 007 — Contas a Pagar |
| [Integrante 4](INTEGRANTE-4-SPECS-004-008.md) | Spec 004 — Formas de Pagamento | Spec 008 — Entrada no Estoque |

Os guias registram os diretórios e branches reservados, o escopo conhecido, as
clarificações e o fluxo que cada responsável executará futuramente.

## Sprints

### Sprint 0 — Adoção do Spec Kit e Rebaseline

Adoção concluída e integrada em `development`, com Constitution e infraestrutura
compartilhável. A reorganização atual prepara os guias por integrante sem implementar
features, alterar requisitos ou criar um DER definitivo.

### Sprint 1 — Cadastros Fundamentais

Specs 001–004: Categorias, Produtos, Fornecedores e Formas de Pagamento. O trabalho de
especificação pode ocorrer em paralelo; implementação e integração respeitam as dependências.
A relação entre categoria, custo e preço de venda deve ser coordenada entre 001, 002 e 006.

### Sprint 2 — Fluxo de Compra

Specs 005–008: Compras, Atualização de Custos e Preço de Venda, Contas a Pagar e Entrada
no Estoque. A implementação depende da base necessária integrada em `development`.
A média, os gatilhos de preço/estoque, o parcelamento e a geração de contas a pagar
continuam sujeitos às clarificações do contexto e dos guias. Não presumir automações.

### Sprint 3 — Vendas

**BLOQUEADA — AGUARDANDO REQUISITOS ATUALIZADOS DE VENDA DO PROFESSOR.**

Não criar Specs 009+. O título do projeto não autoriza inventar o novo modelo de vendas.

### Sprint 4 — Convergência e Revisão

Cada integrante revisará suas duas Specs: Integrante 1, 001/005; Integrante 2, 002/006;
Integrante 3, 003/007; Integrante 4, 004/008. Usar `$speckit-converge` e, havendo lacunas,
revisar as tarefas geradas e repetir `$speckit-implement` → `$speckit-converge`.

Revisão cruzada: Integrante 1 revisa Integrante 2; Integrante 2 revisa Integrante 3;
Integrante 3 revisa Integrante 4; Integrante 4 revisa Integrante 1. A revisão das Specs
já disponíveis não permite declarar concluída a parte de vendas ainda bloqueada.

## Fluxo Git oficial

```text
feature/spec → development → main
```

`development` é a branch de integração. `main` recebe somente versões estáveis e
consolidadas, por PR de `development`. Features nunca partem da `main` nem abrem PR
diretamente para ela. Os comandos deste documento são instruções futuras; nenhum
commit, push ou merge será executado nesta reorganização.

## Regras de trabalho em paralelo e prevenção de conflitos

### Regra 1 — Uma branch por Spec

Nunca desenvolver duas Specs na mesma branch. Cada branch nasce da `development`:

```bash
git checkout development
git pull origin development
git checkout -b feature/001-categorias
```

Exemplos: `feature/001-categorias`, `feature/002-produtos`, `feature/003-fornecedores`
e `feature/004-formas-pagamento`. Conferir a branch atual antes de iniciar o Codex.

### Regra 2 — Números reservados

```text
001 Categorias
002 Produtos
003 Fornecedores
004 Formas de Pagamento
005 Compras
006 Atualização de Custos
007 Contas a Pagar
008 Entrada no Estoque
```

Não depender da numeração automática do Spec Kit. Ao executar `$speckit-specify`,
informar explicitamente no pedido ao Codex o diretório reservado:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/XXX-nome
```

Substituir `XXX-nome` pelo nome exato do guia do integrante e descrever a feature.
A opção explícita impede que clones diferentes escolham automaticamente o mesmo `001`.
Branch e diretório da Spec são independentes: `feature/001-categorias` usa
`specs/001-categorias`, sem incluir `feature/` no caminho. Conferir o diretório resolvido.

### Regra 3 — Não editar Spec de outro integrante

Cada integrante é responsável somente pelas próprias Specs. Se uma decisão afetar outra
Spec, comunicar o responsável, registrar a dependência e alinhar a decisão. Não editar
silenciosamente os artefatos de outra pessoa. Requisitos alterados devem percorrer
Requisito do professor → Spec → Plan → Tasks → Implementação.

### Regra 4 — Arquivos compartilhados

Evitar alterações simultâneas desnecessárias em:

```text
routes/web.php
database/seeders/DatabaseSeeder.php
README.md
Docs/CONTEXTO.md
Docs/Sprints/README.md
```

Mudanças globais nesses arquivos devem ser pequenas e coordenadas. As Tasks da feature
devem identificar os arquivos afetados, sem serem copiadas para estes guias.

### Regra 5 — Dependências não impedem especificação

A Spec 002 depende conceitualmente da 001, mas o Integrante 2 pode executar specify,
clarify, plan, checklist, tasks e analyze em paralelo, alinhando as decisões com o
Integrante 1. Antes de implementar código dependente de Categoria ou concluir sua
integração, aguardar a 001 em `development` e sincronizar a branch:

```bash
git checkout development
git pull origin development
git checkout feature/002-produtos
git merge development
```

Para este projeto, recomenda-se **merge de `development` para a feature**, por
simplicidade acadêmica. Rebase somente se o grupo adotar expressamente essa prática;
não alternar aleatoriamente entre estratégias. Resolver conflitos e verificar o resultado
antes de prosseguir, sem sobrescrever o trabalho de outro integrante.

### Regra 6 — Ordem recomendada de integração da Sprint 1

```text
001-categorias
      ↓
003-fornecedores
      ↓
004-formas-pagamento
      ↓
002-produtos
```

Categoria é dependência direta de Produto. Fornecedor e Forma de Pagamento são
relativamente independentes; Produto deve ser integrado depois de Categoria. Essa é
uma ordem de integração recomendada e não impede trabalho paralelo de Spec e Plan.

### Regra 7 — Sprint 2 só após base estável

As Specs 005–008 podem ser estudadas antecipadamente. Sua implementação só começa após
as dependências necessárias da Sprint 1 estarem integradas em `development`, respeitando
também as dependências internas da Sprint 2 descritas nos guias:

```text
Sprint 1 → development estável → Sprint 2
```

### Regra 8 — Spec Kit feature ativa é local

`.specify/feature.json` é estado local ignorado pelo Git; não serve para coordenar o
trabalho entre integrantes. Cada pessoa deve usar seu próprio checkout/branch e garantir
que o Spec Kit aponta para sua própria feature. Conferir `SPECIFY_FEATURE_DIRECTORY`
e o contexto ativo antes de executar cada etapa, sobretudo ao alternar entre as duas Specs.
Não versionar esse estado nem compartilhá-lo para selecionar features dos colegas.

### Regra 9 — Antes de implementar

Não executar `$speckit-implement` enquanto houver clarificações críticas abertas,
checklist inadequado, inconsistências críticas apontadas por `$speckit-analyze` ou
dependências necessárias indisponíveis. Spec, Plan e Tasks devem estar consistentes.

### Regra 10 — PR

Cada feature deve gerar um PR independente:

```text
feature/XXX-nome → development
```

Nunca abrir PR de feature diretamente para `main`. Somente versões consolidadas seguem
por PR `development → main`, após revisão. Não integrar duas Specs no mesmo PR de feature.

### Regra 11 — Testes

Antes do PR, executar:

```bash
php artisan test
```

Executar também os cenários de `specs/XXX-feature/quickstart.md`, substituindo o caminho
pelo diretório real da feature. Registrar os resultados para revisão, sem presumir sucesso.

### Regra 12 — Convergência

Antes de considerar a feature concluída, executar `$speckit-converge`. Se houver lacunas,
revisar o trabalho restante e repetir:

```text
$speckit-implement
$speckit-converge
```

Continuar até o resultado esperado **`Converged`**, com os critérios de aceitação
validados. Os comandos e cenários de negócio acima serão executados nas futuras features;
esta reorganização não cria Specs nem implementa funcionalidades.
