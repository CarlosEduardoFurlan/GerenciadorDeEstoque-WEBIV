# Tasks: Cadastro de Fornecedores

**Input**: Design documents from `/specs/003-fornecedores/`
**Prerequisites**: [plan.md](plan.md) (required), [spec.md](spec.md) (required for user stories), [research.md](research.md), [data-model.md](data-model.md), [contracts/routes-and-ui.md](contracts/routes-and-ui.md), [quickstart.md](quickstart.md)

**Tests**: As tarefas de testes automatizados (`FornecedorTest`) estão incluídas por história de usuário conforme previsto no [plan.md](plan.md) e em [quickstart.md](quickstart.md) para validar os critérios de aceitação da Constituição antes da abertura do PR.

**Organization**: As tarefas estão organizadas por história de usuário (P1 → P2 → P3) para permitir implementação incremental e validação independente.

## Format: `[ID] [P?] [Story] Description`

- **[P]**: Pode ser executada em paralelo (arquivos distintos, sem dependência de tarefa incompleta)
- **[Story]**: História de usuário atendida pela tarefa (`US1`, `US2`, `US3`)
- Todas as tarefas informam o caminho exato do arquivo afetado

## Path Conventions

- Estrutura monolítica Laravel 13 na raiz do repositório (`app/`, `database/`, `resources/views/`, `routes/`, `tests/`).

---

## Phase 1: Setup (Shared Infrastructure)

**Purpose**: Configuração compartilhada de paginação Bootstrap 5 e layout base das views Blade.

- [X] T001 Configurar `Paginator::useBootstrapFive()` no método `boot()` em `app/Providers/AppServiceProvider.php`
- [X] T002 [P] Criar layout base Bootstrap 5 com navbar (incluindo link para `/fornecedor/listar`) e `@yield('conteudo')` em `resources/views/template.blade.php`

---

## Phase 2: Foundational (Blocking Prerequisites)

**Purpose**: Infraestrutura central obrigatória (schema SQLite, Model Eloquent, Form Request e grupo de rotas protegidas) antes das histórias de usuário.

**⚠️ CRITICAL**: Nenhuma história de usuário deve iniciar antes da conclusão desta fase.

- [X] T003 Criar migration da tabela `fornecedor` com colunas `id` (`PRIMARY KEY` auto-incremento), `nome` (`string(255)`, `NOT NULL`, `INDEX`), `documento` (`string(30)`, `NOT NULL`), `email` (`string(255)`, `NOT NULL`), `endereco` (`string(255)`, `NOT NULL`), `telefone` (`string(30)`, `NOT NULL`) e `timestamps()` (`created_at` e `updated_at` nullable) em `database/migrations/2026_11_18_000003_create_fornecedor_table.php`
- [X] T004 [P] Criar model Eloquent `Fornecedor` com `$table = 'fornecedor'` e `$fillable = ['nome', 'documento', 'email', 'endereco', 'telefone']` em `app/Models/Fornecedor.php`
- [X] T005 [P] Criar classe de validação `FornecedorRequest` com `authorize()` retornando `true`, `rules()` (`id`: `nullable|integer`; `nome`: `required|string|max:255`; `documento`: `required|string|max:30`; `email`: `required|string|email:rfc|max:255`; `endereco`: `required|string|max:255`; `telefone`: `required|string|max:30`) e `messages()` em português (`nome.required`: `"Nome é obrigatório."`, `nome.max`: `"Nome deve ter no máximo 255 caracteres."`, `documento.required`: `"Documento é obrigatório."`, `documento.max`: `"Documento deve ter no máximo 30 caracteres."`, `email.required`: `"E-mail é obrigatório."`, `email.email`: `"E-mail inválido."`, `email.max`: `"E-mail deve ter no máximo 255 caracteres."`, `endereco.required`: `"Endereço é obrigatório."`, `endereco.max`: `"Endereço deve ter no máximo 255 caracteres."`, `telefone.required`: `"Telefone é obrigatório."`, `telefone.max`: `"Telefone deve ter no máximo 30 caracteres."`) em `app/Http/Requests/FornecedorRequest.php`
- [X] T006 Configurar estrutura de grupo de rotas protegidas por `Route::middleware('auth')` para `/fornecedor/*` (e rota nomeada `login` de fallback caso Spec 009 ainda não esteja integrada) em `routes/web.php`

**Checkpoint**: Fundação pronta — a implementação das histórias de usuário pode começar.

---

## Phase 3: User Story 1 - Cadastrar e Listar Fornecedores (Priority: P1) 🎯 MVP

**Goal**: Permitir que usuários autenticados cadastrem novos fornecedores validados e consultem a listagem ordenada por `nome` paginada de 10 em 10 registros.

**Independent Test**: Acessar `/fornecedor/listar` autenticado, abrir `/fornecedor/novo`, validar rejeição de envio inválido com preservação de valores preenchidos, salvar fornecedor válido e conferir exibição na listagem paginada de 10 registros ordenada por `nome`.

### Implementation for User Story 1

- [X] T007 [US1] Implementar actions `listar()` (`Fornecedor::orderBy('nome')->paginate(10)`), `novo()` (instância `Fornecedor` com `id = 0` e campos vazios) e `salvar(FornecedorRequest $request)` (criação quando `id == 0` e redirecionamento para `/fornecedor/listar`) em `app/Http/Controllers/FornecedorController.php`
- [X] T008 [P] [US1] Criar view de listagem paginada com `@extends('template')`, botão "Novo Fornecedor" (`/fornecedor/novo`), tabela Bootstrap 5 (colunas `ID`, `Nome`, `Documento`, `E-mail`, `Endereço`, `Telefone`, `Editar`, `Excluir`), tratamento de lista vazia e `{{ $fornecedores->links() }}` em `resources/views/listagem_fornecedor.blade.php`
- [X] T009 [P] [US1] Criar view de formulário com `@extends('template')`, bloco `@if ($errors->any())` em `div.alert.alert-danger`, form `POST` para `{{ url('fornecedor/salvar') }}` com `@csrf` e campos `id` (`readonly`), `nome`, `documento`, `email`, `endereco` e `telefone` preservados com `old()` em `resources/views/formulario_fornecedor.blade.php`
- [X] T010 [US1] Registrar rotas `GET /fornecedor/listar`, `GET /fornecedor/novo` e `POST /fornecedor/salvar` apontando para `FornecedorController` dentro do grupo `middleware('auth')` em `routes/web.php`
- [X] T011 [US1] Implementar testes automatizados para proteção `auth`, listagem paginada de 10 registros ordenada por `nome`, criação de fornecedor válido (`id = 0`) e rejeição de campos obrigatórios vazios ou e-mail inválido com preservação de `old()` em `tests/Feature/FornecedorTest.php`

**Checkpoint**: User Story 1 (MVP) totalmente funcional e testável de forma independente.

---

## Phase 4: User Story 2 - Editar Dados de Fornecedor (Priority: P2)

**Goal**: Permitir que usuários autenticados carreguem um fornecedor existente no formulário e atualizem seus dados cadastrais com validação.

**Independent Test**: Abrir `/fornecedor/editar/{id}` para um fornecedor existente, verificar campos preenchidos com `id` somente leitura, validar preservação de valores em submissão inválida, salvar dados válidos sem duplicar o registro e validar retorno `404` para `id` inexistente.

### Implementation for User Story 2

- [X] T012 [US2] Implementar action `editar($id)` com `Fornecedor::findOrFail($id)` e complementar `salvar(FornecedorRequest $request)` para atualizar fornecedor existente via `Fornecedor::findOrFail($request->id)` quando `id > 0` em `app/Http/Controllers/FornecedorController.php`
- [X] T013 [US2] Registrar rota `GET /fornecedor/editar/{id}` apontando para `FornecedorController@editar` dentro do grupo `middleware('auth')` em `routes/web.php`
- [X] T014 [US2] Adicionar testes automatizados para exibição do formulário de edição preenchido, atualização de fornecedor existente sem duplicação, falha de validação na edição e retorno `404` para `id` inexistente em `tests/Feature/FornecedorTest.php`

**Checkpoint**: User Stories 1 e 2 funcionais e testáveis de forma independente.

---

## Phase 5: User Story 3 - Excluir Fornecedor (Priority: P3)

**Goal**: Permitir que usuários autenticados excluam um fornecedor existente a partir da listagem.

**Independent Test**: Acionar `/fornecedor/excluir/{id}` para um fornecedor existente e confirmar redirecionamento para `/fornecedor/listar` com remoção no banco SQLite, além de retorno `404` para `id` inexistente.

### Implementation for User Story 3

- [X] T015 [US3] Implementar action `excluir($id)` com `Fornecedor::findOrFail($id)->delete()` e redirecionamento para `/fornecedor/listar` em `app/Http/Controllers/FornecedorController.php`
- [X] T016 [US3] Registrar rota `GET /fornecedor/excluir/{id}` apontando para `FornecedorController@excluir` dentro do grupo `middleware('auth')` em `routes/web.php`
- [X] T017 [US3] Adicionar testes automatizados para exclusão de fornecedor existente e retorno `404` ao tentar excluir `id` inexistente em `tests/Feature/FornecedorTest.php`

**Checkpoint**: Todas as histórias de usuário (US1, US2 e US3) estão implementadas e verificadas.

---

## Phase 6: Polish & Cross-Cutting Concerns

**Purpose**: Dados fictícios para validação manual de paginação e verificação integral do guia `quickstart.md`.

- [X] T018 [P] Criar `FornecedorSeeder` gerando 15 fornecedores fictícios para validação de paginação de 10 registros por página em `database/seeders/FornecedorSeeder.php`
- [X] T019 Executar suíte de testes `php artisan test --filter=FornecedorTest` e validar todos os cenários descritos em `specs/003-fornecedores/quickstart.md`

---

## Dependencies & Execution Order

### Phase Dependencies

- **Setup (Phase 1)**: Sem dependências — inicia imediatamente.
- **Foundational (Phase 2)**: Depende do Setup (Phase 1) — bloqueia todas as histórias de usuário.
- **User Stories (Phases 3, 4 e 5)**: Todas dependem da conclusão da Phase 2 (`T003`–`T006`).
  - `US1 (Phase 3)` → entrega o MVP (listagem paginada + novo cadastro).
  - `US2 (Phase 4)` → depende da estrutura inicial de `FornecedorController` (`T007`) e reutiliza `formulario_fornecedor.blade.php` (`T009`).
  - `US3 (Phase 5)` → depende de `FornecedorController` (`T007`) e da listagem (`T008`).
- **Polish (Phase 6)**: Depende da conclusão de `US1`, `US2` e `US3`.

### User Story Dependencies

- **User Story 1 (P1)**: Independente após Phase 2.
- **User Story 2 (P2)**: Reutiliza `FornecedorController` e `formulario_fornecedor.blade.php` da US1, mas tem escopo e validação próprios (`editar` + atualização em `salvar`).
- **User Story 3 (P3)**: Adiciona a ação destrutiva `excluir` ao ciclo iniciado na US1.

### Parallel Opportunities

- **Phase 1**: `T001` (`AppServiceProvider.php`) e `T002` (`template.blade.php`) em paralelo.
- **Phase 2**: `T004` (`Fornecedor.php`) e `T005` (`FornecedorRequest.php`) em paralelo após ou junto com `T003` (migration).
- **Phase 3 (US1)**: `T008` (`listagem_fornecedor.blade.php`) e `T009` (`formulario_fornecedor.blade.php`) podem ser criadas em paralelo enquanto `T007` (`FornecedorController.php`) é implementado.
- **Phase 6**: `T018` (`FornecedorSeeder.php`) pode ser desenvolvido em paralelo às etapas finais antes da validação `T019`.

---

## Parallel Example: User Story 1

```bash
# Após concluir Phase 2 (T003-T006), executar em paralelo os artefatos de US1 com arquivos distintos:
Task: "T007 [US1] Implementar listar(), novo() e salvar() (criação) em app/Http/Controllers/FornecedorController.php"
Task: "T008 [P] [US1] Criar view de listagem paginada em resources/views/listagem_fornecedor.blade.php"
Task: "T009 [P] [US1] Criar view de formulário em resources/views/formulario_fornecedor.blade.php"
```

---

## Implementation Strategy

### MVP First (User Story 1 Only)

1. Concluir **Phase 1: Setup** (`T001`–`T002`).
2. Concluir **Phase 2: Foundational** (`T003`–`T006`).
3. Concluir **Phase 3: User Story 1** (`T007`–`T011`).
4. **PARAR e VALIDAR**: Rodar `php artisan test --filter=FornecedorTest` e testar listagem paginada (10 registros) + criação via navegador.

### Incremental Delivery

1. Setup + Foundational → Base pronta (`fornecedor` no SQLite, Model, Request e grupo `auth`).
2. User Story 1 → Listagem paginada + Novo cadastro + Validações (**MVP**).
3. User Story 2 → Edição e atualização de fornecedor existente.
4. User Story 3 → Exclusão de fornecedor existente.
5. Polish (`T018`–`T019`) → Seeder para testes manuais e validação final do `quickstart.md`.

---

## Notes

- Tarefas marcadas com `[P]` atuam em arquivos distintos e não dependem de tarefas em aberto.
- Os rótulos `[US1]`, `[US2]` e `[US3]` mapeiam cada tarefa diretamente para as histórias de [spec.md](spec.md).
- Antes do PR para `development`, verificar que todas as tarefas estão concluídas, os testes passam sem falhas e `.specify/feature.json` não foi adicionado ao commit.
