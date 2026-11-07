# Roadmap de Sprints e Specs

Este roadmap organiza o **Sistema de Compras e Vendas** por temas, dependências e
responsáveis. As tarefas executáveis ficarão exclusivamente em `specs/<numero>-<tema>/tasks.md`.
Não duplicar manualmente tarefas nem manter checklists de implementação em `Docs/Sprints/`.

As fontes de referência são os requisitos atualizados do professor, a
[Constitution](../../.specify/memory/constitution.md), as futuras Specs e o
[contexto atual](../CONTEXTO.md), que reúne a visão geral e as ambiguidades.
O [planejamento anterior](../Legado/Sprints-Anteriores/README.md) é apenas histórico.

Os números 001–008 abaixo são **reservas de planejamento**: nenhuma dessas Specs deve
ser criada nesta Sprint 0. Cada integrante criará sua Spec posteriormente. Os nomes
“Integrante 1” a “Integrante 4” preservam a divisão fornecida; o grupo pode associá-los
aos nomes reais sem alterar a responsabilidade prevista.

## Sprint 0 — Adoção do Spec Kit e Rebaseline

**Responsável:** grupo inteiro.

Objetivos: instalar e inicializar o Spec Kit no repositório existente com integração
`codex`; criar a Constitution; atualizar contexto e README; retirar o DER antigo como
modelo ativo preservando o histórico; criar este roadmap. Não implementar features,
não criar Specs 001–008 e não gerar um novo DER definitivo nesta sprint.

A revisão de saída deve confirmar que os arquivos compartilháveis do Spec Kit estão
disponíveis, a integração funciona, os dez pontos de clarificação estão registrados e
nenhum código de negócio foi criado. A validação do ambiente local de cada integrante
continua conforme o README.

## Sprint 1 — Cadastros Fundamentais

| Integrante | Spec | Tema |
|---|---|---|
| Integrante 1 | 001 | Categorias |
| Integrante 2 | 002 | Produtos |
| Integrante 3 | 003 | Fornecedores |
| Integrante 4 | 004 | Formas de Pagamento |

### 001-categorias

**Integrante 1.** Escopo: descrição, margem de lucro, CRUD, validações e participação
da margem na formação do preço de venda. Clarificar com as Specs 002/006 se a alteração
da margem exige recálculo dos produtos existentes.

### 002-produtos

**Integrante 2.** Escopo: descrição, categoria, valor de compra, valor de venda,
quantidade em estoque e regra do valor de venda conforme a margem da categoria.
**Dependência conceitual:** Spec 001. Clarificar os gatilhos de recálculo de preço e
coordenar a decisão com 001/006. Não incorporar campos antigos sem requisito atualizado.

### 003-fornecedores

**Integrante 3.** Escopo: nome, documento, email, endereço, telefone, CRUD e validações.
Não assumir CNPJ como único tipo de documento.

### 004-formas-pagamento

**Integrante 4.** Escopo: descrição, número de parcelas, itens, porcentagem e `dia`
inteiro. Clarify obrigatório: significado de `dia`, relação entre `numero_parcelas` e
quantidade de itens, e soma das porcentagens. O relacionamento técnico dos itens com
a forma de pagamento pertence ao Plan/Data Model, depois das clarificações.

## Sprint 2 — Fluxo de Compra

| Integrante | Spec | Tema |
|---|---|---|
| Integrante 1 | 005 | Compras |
| Integrante 2 | 006 | Atualização de Custos e Preço de Venda |
| Integrante 3 | 007 | Contas a Pagar |
| Integrante 4 | 008 | Entrada no Estoque |

### 005-compras

**Integrante 1.** Escopo: documento, fornecedor, data, forma de pagamento, valor,
itens, produto, quantidade, valor unitário, valor total e cálculo de subtotal/total.
Planejar sobre os cadastros 002, 003 e 004. Coordenar com 006, 007 e 008 os efeitos da
compra, sem presumir fluxo de status, finalização ou automações do modelo anterior.

### 006-atualizacao-custos

**Integrante 2.** Escopo: atualização de `produto.valor_compra`, média aritmética
definida pelo professor e atualização de `valor_venda` conforme a margem da categoria.
**Clarify obrigatório:** fórmula exata da média e conjunto de valores participantes.
Clarificar também os gatilhos de recálculo de venda, em conjunto com 001/002/005.
Nenhuma fórmula deve ser assumida antes dessa resposta.

### 007-contas-pagar

**Integrante 3.** Escopo: documento, fornecedor, compra, vencimento, valor e data de
pagamento. Clarificar geração automática, relação com forma de pagamento e cálculo
dos vencimentos, incluindo se `data_vencimento` corresponde a `compra.data + dia`.
Coordenar as decisões com 004/005 antes do Plan e da implementação.

### 008-entrada-estoque

**Integrante 4.** Escopo provável: atualização de `quantidade_estoque` após compra.
**Regra condicionada a Clarify antes da implementação:** a folha nova mostra estoque
no produto, mas não descreve diretamente se a compra altera o saldo automaticamente
nem em qual momento. Coordenar com 002/005. Esta reserva de roadmap não confirma a regra
nem autoriza criar uma entidade de Movimentação de Estoque.

As dependências acima organizam o trabalho; os Plans definirão a integração técnica.
Não implementar efeitos compartilhados de compra, custo, estoque e financeiro de forma
independente sem conciliar as decisões e a necessidade de transações.

## Sprint 3 — Vendas

**Status: BLOQUEADA — AGUARDANDO NOVOS REQUISITOS DO PROFESSOR.**

A parte de vendas está **AGUARDANDO REQUISITOS ATUALIZADOS DO PROFESSOR**.
Não criar Specs 009+ ainda e não reutilizar Cliente, Venda, Venda Item ou orçamentos do
DER antigo como modelo ativo. Quando o material chegar, atualizar primeiro requisitos
e documentação, depois Specs, Plans, Tasks e código.

## Sprint 4 — Convergência e Revisão

Cada integrante revisará suas próprias Specs:

| Responsável | Specs |
|---|---|
| Integrante 1 | 001 e 005 |
| Integrante 2 | 002 e 006 |
| Integrante 3 | 003 e 007 |
| Integrante 4 | 004 e 008 |

Executar para cada feature, no seu contexto:

```text
$speckit-converge
```

Se houver novas tarefas, revisá-las e repetir:

```text
$speckit-implement
$speckit-converge
```

Continuar até obter convergência, com evidências de validação dos critérios da Spec.
A revisão de compras pode ocorrer enquanto vendas aguarda requisitos; isso não permite
declarar concluída a parte de vendas.

**Revisão cruzada:** Integrante 1 revisa Integrante 2; Integrante 2 revisa Integrante 3;
Integrante 3 revisa Integrante 4; Integrante 4 revisa Integrante 1.

## Como cada integrante desenvolverá sua Spec

Após a revisão da Sprint 0, partir da `main` atualizada em um checkout próprio e abrir
o Codex na raiz do repositório. Informar o número reservado e o tema ao criar a feature;
conferir o número e a branch gerados antes de continuar. O CLI está configurado para
numeração sequencial: o grupo deve coordenar a criação para evitar que checkouts ainda
sem as Specs dos colegas reservem o mesmo número. Não gerar as oito Specs nesta tarefa.

Executar **no chat do Codex**, uma skill por vez, lendo e revisando o resultado:

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

`clarify` registra as decisões sobre dúvidas; `checklist` verifica a qualidade dos
requisitos; `analyze` verifica consistência entre os artefatos; `converge` compara os
artefatos com a implementação e registra trabalho restante. Spec, Plan e Tasks devem
estar consistentes antes de iniciar `implement`. Ambiguidades que afetam a feature
devem ser resolvidas com o professor ou em Clarify, sem respostas inventadas.

| Artefato futuro em `specs/<numero>-<tema>/` | Finalidade |
|---|---|
| `spec.md` | WHAT e WHY: o que entregar, por quê, user stories quando aplicáveis, critérios de aceitação, cenários independentes, casos de erro e conclusão mensurável |
| `plan.md` | HOW técnico: abordagem Laravel, dependências, conformidade com a Constitution e estratégia de validação |
| `tasks.md` | Tarefas executáveis e acompanhamento da implementação, sem duplicação em `Docs/Sprints/` |
| `checklists/` | Qualidade dos requisitos: clareza, completude e consistência |
| `data-model.md` | Modelo de dados da feature, relacionamentos e constraints justificados |
| `quickstart.md` | Como validar a feature e reproduzir seus cenários |
| `research.md` | Decisões que precisaram de pesquisa e suas justificativas |

Em mudanças de requisito, atualizar na ordem **Requisito do professor → Spec → Plan →
Tasks → Implementação** e sincronizar as Specs afetadas. Ao concluir a feature, registrar
as verificações, revisar o diff e abrir Pull Request para revisão cruzada antes do merge.
