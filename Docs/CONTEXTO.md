# Contexto do projeto — Sistema de Compras e Vendas

Atualizado em 2026-11-07, na Sprint 0 — Adoção do Spec Kit e Rebaseline.

## 1. Visão geral e fontes de referência

Trabalho acadêmico da disciplina **Construção de Páginas Web IV**, curso de **Tecnologia em Sistemas para Internet — IFMS**. O repositório mantém o nome `GerenciadorDeEstoque-WEBIV`; o material atualizado do professor se chama **Projeto Sistema Compras e Vendas**.

A folha atualmente fornecida contém somente a seção **DE COMPRA**. Este registro reproduz os requisitos informados pelo usuário a partir desse material; a folha original atualizada não está anexada ao repositório. Não existe ainda um novo DER definitivo.

A prioridade das fontes é:

1. requisitos e modelos atualizados fornecidos pelo professor;
2. [Constitution](../.specify/memory/constitution.md), com os princípios do projeto;
3. especificações detalhadas de cada feature em `specs/`, seguidas de seus Plans e Tasks.

**As Specs serão a fonte detalhada de verdade das features.** Este `CONTEXTO.md` é apenas uma visão geral, histórico e registro do estado atual; não substitui as Specs. O [roadmap de Sprints](Sprints/README.md) organiza temas e responsáveis, sem duplicar tarefas de implementação.

A parte **DE VENDA** permanece **AGUARDANDO REQUISITOS ATUALIZADOS DO PROFESSOR**. O título do projeto não autoriza inventar entidades ou regras de vendas.

## 2. Stack e convenções

| Camada | Tecnologia e convenção |
|---|---|
| Backend | PHP 8.3+ e Laravel 13 |
| Banco | PostgreSQL; toda estrutura por migrations |
| Interface | Laravel Blade e Bootstrap 5 |
| Assets | Vite; JavaScript somente quando necessário |
| Arquitetura | MVC convencional do Laravel, Eloquent ORM, Form Requests e Services quando houver regras relevantes |
| Domínio | Português: Categoria, Produto, Fornecedor, FormaPagamento, Compra, ContaPagar etc. |
| Tabelas | Português e `snake_case`; nomes e relacionamentos técnicos definidos no Plan/Data Model |
| Dinheiro | NUMERIC/DECIMAL; nunca FLOAT |

Regras críticas devem ser validadas no backend. Operações que alterem compra, produto, estoque ou financeiro em conjunto devem utilizar transações quando necessário. Priorizar clareza, organização, facilidade de explicação e funcionamento correto, evitando complexidade sem justificativa.

A configuração existente mantém o banco local `controle_estoque`, locale `pt_BR` e timezone da aplicação `America/Campo_Grande`. O nome local em `.env.example` continua `Controle de Estoque`; esta tarefa não altera configuração da aplicação. As instruções de instalação ficam no [README](../README.md).

## 3. Requisitos vigentes — DE COMPRA

Os campos abaixo são os informados pelo professor. Referências como `categoria`, `fornecedor`, `forma_pagamento`, `produto` e `compra` representam conceitos do material, não decisões antecipadas sobre nomes de FKs. Tipos, tamanhos, precisão, nulabilidade, cardinalidades, identificadores técnicos dos itens e constraints serão definidos nos Plans/Data Models após as clarificações pertinentes.

| Entidade | Informações fornecidas |
|---|---|
| Categoria | `id`, `descricao`, `margem_lucro` |
| Produto | `id`, `descricao`, `valor_compra`, `valor_venda`, `categoria`, `quantidade_estoque` |
| Fornecedor | `id`, `nome`, `documento`, `email`, `endereco`, `telefone` |
| Forma de Pagamento | `id`, `descricao`, `numero_parcelas` |
| Item da Forma de Pagamento | `porcentagem`, `dia` (inteiro) |
| Compra | `id`, `documento`, `fornecedor`, `data`, `forma_pagamento`, `valor` |
| Item da Compra | `produto`, `quantidade`, `valor_unitario`, `valor_total` |
| Contas a Pagar | `id`, `documento`, `fornecedor`, `compra`, `data_vencimento`, `valor`, `data_pagamento` |

O relacionamento técnico entre Item da Forma de Pagamento e `forma_pagamento` será definido posteriormente no Plan/Data Model da feature.

### Regras informadas

- O valor de venda do produto deve corresponder à margem de lucro de sua categoria.
- O valor de compra do produto deve ser atualizado conforme a compra realizada, utilizando a média aritmética.
- **Contas a pagar fazem parte explicitamente do escopo atual.** A exclusão desse tema no contexto anterior foi substituída pelo requisito atualizado.

Não está definida a fórmula exata da média nem o conjunto de valores que participa dela. Não presumir média ponderada, média de dois preços ou média de todas as compras. A definição será registrada na Spec correspondente após `$speckit-clarify` ou resposta do professor.

A relação entre margem e preço é um requisito; seus gatilhos de recálculo ainda precisam de clarificação. Não presumir atualizações automáticas de estoque, geração de parcelas, vencimentos ou contas a pagar. `documento` do fornecedor não significa exclusivamente CNPJ.

## 4. Pontos que exigem clarificação

As perguntas abaixo permanecem **em aberto**. Cada responsável deve levá-las à Spec pertinente, executar `$speckit-clarify` e registrar a resposta e sua origem, consultando o professor quando necessário. Nenhuma resposta é presumida nesta rebaseline.

| Nº | Pergunta | Specs previstas afetadas |
|---|---|---|
| 1 | O que exatamente significa a média aritmética utilizada para atualizar `valor_compra`? Qual conjunto de valores participa dela? | 006 |
| 2 | A compra deve aumentar automaticamente `quantidade_estoque`? Em qual momento? | 005, 008 |
| 3 | `numero_parcelas` deve ser exatamente igual à quantidade de itens da forma de pagamento? | 004 |
| 4 | A soma das porcentagens dos itens deve obrigatoriamente ser 100%? | 004 |
| 5 | O campo inteiro `dia` significa quantidade de dias após a compra, dia fixo do mês ou outra regra? | 004, 007 |
| 6 | As contas a pagar devem ser geradas automaticamente ao registrar/finalizar uma compra? | 005, 007 |
| 7 | `data_vencimento` é calculada a partir de `compra.data + dia`? | 004, 007 |
| 8 | Quando `valor_compra` mudar, `valor_venda` deve ser recalculado automaticamente? | 002, 006 |
| 9 | Quando `margem_lucro` da categoria mudar, os produtos dessa categoria devem ter `valor_venda` recalculado? | 001, 002, 006 |
| 10 | Quais são os novos requisitos da parte `DE VENDA`? | Sprint 3; sem Specs 009+ por enquanto |

Uma decisão compartilhada deve ser refletida em todas as Specs afetadas antes de seus Plans, Tasks e implementação. Os números acima são referências de clarificação, não tarefas executáveis.

## 5. O que mudou e o que virou legado

| Tema | Definição ativa após o material atualizado |
|---|---|
| Categoria | `descricao` e `margem_lucro`, além de `id`; `nome` e `ativo` não são campos obrigatórios vigentes |
| Produto | `descricao` e `quantidade_estoque`; não manter `nome`, `embalagem`, `qtde_estoque`, `qtde_minima`, `qtde_maxima`, `codigo_barra` ou `ativo` como requisitos obrigatórios |
| Fornecedor | `nome`, `documento`, `email`, `endereco`, `telefone`; `razao_social`, `nome_fantasia`, `fone`, `cnpj` e `ativo` não são requisitos obrigatórios vigentes |
| Novas entidades | Forma de Pagamento, Item da Forma de Pagamento e Contas a Pagar |
| Vendas | Aguardando requisitos atualizados; não reaproveitar o modelo antigo como oficial |

Orçamento de Compra, Orçamento de Venda, Movimentação de Estoque, Cliente, Venda, Venda Item, estoque mínimo/máximo, código de barras, campo `ativo` e demais decisões não confirmadas pela atualização foram retirados do modelo ativo. Regras antigas de status, confirmação, conversão de orçamentos e movimentações também não são herdadas automaticamente.

O [DER anterior](Legado/DER-ANTERIOR.jpg) **NÃO representa mais o modelo oficial do projeto**. O [contexto anterior](Legado/CONTEXTO-ANTERIOR.md) e o [planejamento anterior](Legado/Sprints-Anteriores/README.md) foram preservados como história, sem autoridade sobre novas features. Veja o [índice do legado](Legado/README.md). Nenhum novo DER definitivo foi criado.

## 6. Desenvolvimento orientado a Specs

O projeto usa **GitHub Spec Kit**, integração oficial **`codex`**, com skills compartilháveis em `.agents/skills/`, scripts PowerShell, templates e Constitution em `.specify/`.

```text
Requisitos do professor → Constitution → Specs → Plan → Tasks → Código
```

Para cada feature futura, seguir no chat do Codex:

```text
$speckit-specify → $speckit-clarify → $speckit-plan → $speckit-checklist
→ $speckit-tasks → $speckit-analyze → $speckit-implement → $speckit-converge
```

Spec, Plan e Tasks devem estar consistentes antes da implementação. Os artefatos detalhados ficarão em `specs/<numero>-<tema>/`; o [roadmap](Sprints/README.md) explica os arquivos e a divisão entre os quatro integrantes. Não duplicar manualmente as Tasks em `Docs/Sprints/`.

## 7. Estado atual e próximo passo

A inspeção inicial encontrou somente o esqueleto Laravel: Model `User`, Controller base, provider padrão, migrations de usuários/sessões, cache e jobs, factory/seeder padrão, rota `/`, comando `inspire`, página de boas-vindas e testes de exemplo. Não havia implementação relevante das entidades de negócio.

Esta Sprint 0 prepara Spec Kit, Constitution, documentação e roadmap. Na auditoria final, Laravel Boost foi removido por não integrar a stack nem ser necessário ao Spec Kit/Codex. `composer.json` e `composer.lock` foram restaurados ao estado anterior, sem alteração de outras dependências. As instruções antigas que exigiam Boost foram substituídas. O código da aplicação e suas migrations permanecem preservados.

**Nenhuma Spec 001–008 foi criada e nenhuma funcionalidade foi implementada nesta tarefa.** Não existe ainda diretório de feature em `specs/`. O próximo passo, após revisão da Sprint 0, é cada integrante iniciar sua própria Spec da Sprint 1: 001-categorias, 002-produtos, 003-fornecedores e 004-formas-pagamento. A criação geral de migrations a partir do DER antigo deixou de ser a próxima etapa.

A validação do ambiente PostgreSQL e a instalação em outro computador continuam sendo verificações de cada integrante; não devem ser consideradas concluídas apenas porque o processo documental foi preparado.
