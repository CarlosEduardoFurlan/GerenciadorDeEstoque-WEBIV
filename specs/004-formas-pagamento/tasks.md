# Tasks: Formas de Pagamento

**Input**: Design documents from `specs/004-formas-pagamento/`

**Prerequisites**: plan.md, spec.md, research.md, data-model.md, contracts/, quickstart.md

**Tests**: Testes Laravel/PHPUnit são obrigatórios pela Spec, pelo Plan e pela solicitação do usuário.

**Organization**: Tasks are grouped by user story to enable independent implementation and testing of each story.

## Format: `[ID] [P?] [Story] Description`

- **[P]**: Pode executar em paralelo quando não altera o mesmo arquivo nem depende de tarefa incompleta.
- **[Story]**: Mapeia a tarefa à user story correspondente.
- Todos os itens informam o caminho exato do arquivo.

## Phase 1: Setup (Shared Infrastructure)

**Purpose**: Preparar a integração da feature com a aplicação Laravel existente.

- [x] T001 Revisar e preservar o fallback de autenticação e as rotas de fornecedor ao adicionar imports da Spec 004 em routes/web.php
- [x] T002 [P] Definir a estrutura compartilhada das telas da feature compatível com o layout existente em resources/views/template.blade.php

---

## Phase 2: Foundational (Blocking Prerequisites)

**Purpose**: Criar persistência e modelos usados por todas as histórias.

**⚠️ CRITICAL**: Nenhuma user story pode ser concluída antes desta fase.

- [x] T003 Criar migration de forma_pagamento com id, descricao obrigatória até 255 caracteres, numero_parcelas inteiro mínimo 1 e timestamps em database/migrations/2026_11_19_000004_create_forma_pagamento_table.php
- [x] T004 Criar migration de item_forma_pagamento com FK obrigatória indexada e cascade, porcentagem decimal (5,2), dia inteiro e timestamps em database/migrations/2026_11_19_000005_create_item_forma_pagamento_table.php
- [x] T005 [P] Criar model FormaPagamento com tabela, fillable e relação hasMany ordenada por dia/id em app/Models/FormaPagamento.php
- [x] T006 [P] Criar model ItemFormaPagamento com tabela, fillable, cast decimal e relação belongsTo em app/Models/ItemFormaPagamento.php

**Checkpoint**: Schema e relação 1:N prontos para as histórias.

---

## Phase 3: User Story 1 - Cadastrar forma de pagamento (Priority: P1) 🎯 MVP

**Goal**: Cadastrar atomicamente uma forma com exatamente um item por parcela e soma de porcentagens igual a 100%.

**Independent Test**: Enviar uma forma válida e confirmar forma/itens persistidos; enviar quantidade ou total inválidos e confirmar erros sem persistência parcial.

### Tests for User Story 1

- [x] T007 [US1] Escrever testes de cadastro válido, campos obrigatórios, um item por parcela, soma 100%, dia inteiro não negativo e ausência de persistência parcial em tests/Feature/FormaPagamentoTest.php

### Implementation for User Story 1

- [x] T008 [US1] Implementar regras básicas e validações cruzadas em centésimos, com mensagens em português, em app/Http/Requests/FormaPagamentoRequest.php
- [x] T009 [US1] Implementar create/store em transação e criação dos itens em app/Http/Controllers/FormaPagamentoController.php
- [x] T010 [P] [US1] Criar parcial de campos com erros visíveis, old input e manipulação simples das linhas de itens em resources/views/formas_pagamento/_form.blade.php
- [x] T011 [US1] Criar página de cadastro usando o parcial em resources/views/formas_pagamento/form.blade.php
- [x] T012 [US1] Registrar rotas autenticadas create/store com nomes do contrato em routes/web.php

**Checkpoint**: Cadastro válido funciona e regras inválidas são rejeitadas no backend.

---

## Phase 4: User Story 2 - Consultar formas de pagamento (Priority: P2)

**Goal**: Listar no máximo dez formas por página e visualizar todos os dados e itens de uma forma.

**Independent Test**: Criar 11 formas, conferir 10 na primeira página e 1 na segunda; abrir detalhes e conferir itens; verificar estado vazio e bloqueio anônimo.

### Tests for User Story 2

- [x] T013 [US2] Adicionar testes de autenticação, estado vazio, paginação 10 e visualização com itens em tests/Feature/FormaPagamentoTest.php

### Implementation for User Story 2

- [x] T014 [US2] Implementar index paginado e show com carregamento dos itens em app/Http/Controllers/FormaPagamentoController.php
- [x] T015 [P] [US2] Criar listagem Bootstrap com estado vazio, mensagens e navegação paginada em resources/views/formas_pagamento/index.blade.php
- [x] T016 [P] [US2] Criar detalhes da forma e tabela de itens em resources/views/formas_pagamento/show.blade.php
- [x] T017 [US2] Registrar rotas autenticadas index/show com nomes do contrato em routes/web.php

**Checkpoint**: Consulta, paginação e detalhes funcionam independentemente da edição.

---

## Phase 5: User Story 3 - Alterar forma de pagamento (Priority: P3)

**Goal**: Alterar a forma e substituir atomicamente sua coleção de itens validada.

**Independent Test**: Alterar uma forma de duas para três parcelas e conferir somente os três itens novos; enviar alteração inválida e confirmar que os dados anteriores permanecem intactos.

### Tests for User Story 3

- [x] T018 [US3] Adicionar testes de edição válida e rollback lógico de alteração inválida em tests/Feature/FormaPagamentoTest.php

### Implementation for User Story 3

- [x] T019 [US3] Implementar edit/update em transação com substituição dos itens em app/Http/Controllers/FormaPagamentoController.php
- [x] T020 [US3] Adaptar página e parcial para edição, método PUT e preservação de itens enviados em resources/views/formas_pagamento/form.blade.php
- [x] T021 [US3] Registrar rotas autenticadas edit/update com nomes do contrato em routes/web.php

**Checkpoint**: Cadastro e alteração são funcionais e atomicamente consistentes.

---

## Phase 6: User Story 4 - Excluir forma de pagamento (Priority: P4)

**Goal**: Excluir uma forma confirmada e seus itens dependentes.

**Independent Test**: Excluir a forma por requisição autenticada e confirmar que forma e itens deixam de existir.

### Tests for User Story 4

- [x] T022 [US4] Adicionar teste de exclusão autenticada com cascade dos itens em tests/Feature/FormaPagamentoTest.php

### Implementation for User Story 4

- [x] T023 [US4] Implementar destroy e mensagem de sucesso em app/Http/Controllers/FormaPagamentoController.php
- [x] T024 [US4] Adicionar formulário DELETE com confirmação explícita na listagem em resources/views/formas_pagamento/index.blade.php
- [x] T025 [US4] Registrar rota autenticada destroy com nome do contrato em routes/web.php

**Checkpoint**: As quatro histórias estão implementadas e testáveis.

---

## Phase 7: Polish & Cross-Cutting Concerns

**Purpose**: Validar a feature completa, documentação e ausência de regressões.

- [x] T026 [P] Ajustar navegação e mensagens compartilhadas da feature sem alterar outras Specs em resources/views/template.blade.php
- [x] T027 Executar formatação aplicável e revisar escopo dos arquivos PHP da Spec 004 com vendor/bin/pint
- [x] T028 Executar testes focados e suíte completa documentados em specs/004-formas-pagamento/quickstart.md
- [x] T029 Validar manualmente ou por testes automatizados todos os sete cenários de specs/004-formas-pagamento/quickstart.md e registrar o resultado nas tasks

---

## Dependencies & Execution Order

### Phase Dependencies

- **Setup (Phase 1)**: sem dependências.
- **Foundational (Phase 2)**: depende da leitura da integração atual; bloqueia todas as histórias.
- **US1 (Phase 3)**: depende da base e entrega o MVP.
- **US2 (Phase 4)**: depende dos models; pode evoluir em paralelo após a base, mas usa dados criados pela US1 nos testes integrados.
- **US3 (Phase 5)**: depende do formulário, request e controller da US1.
- **US4 (Phase 6)**: depende da listagem da US2 e do controller compartilhado.
- **Polish (Phase 7)**: depende das histórias desejadas completas.

### User Story Dependencies

```text
Setup → Foundational → US1 (MVP)
                     ├→ US2
                     └→ US3
US2 + US3 ────────────→ US4 → Polish
```

### Parallel Opportunities

- T002 pode ocorrer em paralelo à análise de T001.
- T005 e T006 podem ocorrer em paralelo depois das migrations definidas.
- T010 pode ocorrer em paralelo a T008/T009 após o contrato de campos estar fixado.
- T015 e T016 podem ocorrer em paralelo após o contrato de consulta.
- T026 pode ocorrer em paralelo à revisão documental, sem tocar arquivos de domínio.

## Parallel Example: User Story 2

```text
Task: "Criar listagem em resources/views/formas_pagamento/index.blade.php"
Task: "Criar detalhes em resources/views/formas_pagamento/show.blade.php"
```

## Implementation Strategy

### MVP First

1. Completar Setup e Foundational.
2. Implementar US1 com os testes escritos antes do código.
3. Validar cadastro e rejeições independentemente.
4. Prosseguir incrementalmente com consulta, alteração e exclusão.

### Incremental Delivery

1. Persistência e models.
2. Cadastro validado e atômico.
3. Listagem paginada e detalhes.
4. Alteração atômica.
5. Exclusão confirmada.
6. Quickstart e suíte completa.

## Notes

- `[P]` indica arquivos diferentes e ausência de dependência incompleta.
- As tasks são a única lista detalhada de implementação; não devem ser copiadas para `Docs/Sprints`.
- Não implementar Specs 008, 012 ou autenticação Breeze nesta branch.
- Não fazer commit, push ou merge durante esta execução.

## Validation Results

- `vendor/bin/pint --dirty`: concluído; arquivos PHP da feature formatados.
- Migrations executadas em SQLite `:memory:`: 6/6 concluídas, incluindo as 2 migrations da Spec 004.
- Contrato de rotas: 7/7 rotas autenticadas registradas.
- Compilação Blade: concluída sem erros.
- Testes focados: 11 testes, 77 assertions, todos aprovados.
- `php artisan test`: 24 testes, 138 assertions, todos aprovados.
- Quickstart: os sete cenários estão cobertos pelos testes automatizados e foram aprovados.

## Phase 8: Convergence

- [x] T030 Adicionar índice explícito para `forma_pagamento_id` em database/migrations/2026_11_19_000005_create_item_forma_pagamento_table.php conforme plan:data-model ItemFormaPagamento (partial)

