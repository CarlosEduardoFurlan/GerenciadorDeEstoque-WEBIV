# Implementation Plan: Cadastro de Fornecedores

**Branch**: `feature/003-fornecedores` | **Date**: 2026-11-18 | **Spec**: [spec.md](spec.md)

**Input**: Feature specification from `/specs/003-fornecedores/spec.md`

## Summary

Implementar o módulo completo de **Cadastro de Fornecedores (Spec 003)** seguindo o padrão MVC ensinado na disciplina e a arquitetura Laravel 13 + SQLite + Blade + Bootstrap 5 definida na Constituição do projeto. O escopo compreende migration e Model `Fornecedor` (tabela `fornecedor`), validação dedicada com `FornecedorRequest`, controlador `FornecedorController` com as actions convencionais (`listar`, `novo`, `salvar`, `editar`, `excluir`), layout base `template.blade.php` com views `listagem_fornecedor.blade.php` e `formulario_fornecedor.blade.php`, paginação de 10 registros por página em Bootstrap 5 e proteção por middleware `auth` compatível com a Spec 009.

## Technical Context

**Language/Version**: PHP 8.3+ / Laravel 13 (`^13.17`)

**Primary Dependencies**: Laravel Framework, Blade, Bootstrap 5 (`^5.3.8`), Vite (`^8.0.0`), Laravel Breeze (integração de autenticação via middleware `auth` da Spec 009)

**Storage**: SQLite (`database/database.sqlite`, tabela `fornecedor`)

**Testing**: PHPUnit (`^12.5.12`) via `php artisan test` (Feature tests com `RefreshDatabase`)

**Target Platform**: Aplicação Web server-side (navegadores desktop/mobile via Bootstrap 5)

**Project Type**: Monólito MVC web (Laravel)

**Performance Goals**: Listagem paginada de 10 registros por página ordenada por índice em `nome`; respostas HTML rápidas em servidor local SQLite

**Constraints**: Banco SQLite obrigatório; validação integral via `FormRequest` com mensagens em português; paginação estrita de 10 registros por página; todas as rotas protegidas por `auth`; aderência ao padrão de rotas e views da disciplina (`listar`, `novo`, `salvar`, `editar`, `excluir`)

**Scale/Scope**: 1 entidade (`Fornecedor`), 1 migration, 1 model, 1 form request, 1 controller, 1 layout base (`template.blade.php`) + 2 views específicas, 1 seeder e suíte de testes automatizados `FornecedorTest`

## Constitution Check

*GATE: Must pass before Phase 0 research. Re-check after Phase 1 design.*

| Princípio / Regra | Status | Avaliação (Pré-Phase 0 e Pós-Phase 1) |
|---|---|---|
| **I. Requisitos do professor como fonte primária** | PASS | Campos `id`, `nome`, `documento`, `email`, `endereco`, `telefone` e padrão MVC da disciplina integralmente atendidos. |
| **II. Spec-Driven Development** | PASS | Fluxo seguido na ordem (`specify` concluído em `specs/003-fornecedores/spec.md`; nenhum marcador `[NEEDS CLARIFICATION]` pendente). |
| **III. Stack obrigatória e autenticação** | PASS | PHP 8.3+, Laravel 13, SQLite, Blade, Bootstrap 5, Vite; rotas agrupadas sob middleware `auth` compatível com Laravel Breeze (Spec 009). |
| **IV. Banco de dados e persistência** | PASS | Tabela `fornecedor` criada via migration Laravel com PK `id` e índice em `nome`; sem campos monetários nesta entidade. |
| **V. Regras de negócio no backend** | PASS | Validação executada no backend via `FornecedorRequest` (`rules()` e `messages()`), com preservação de `old()` nas views. |
| **VI. Simplicidade** | PASS | MVC direto com Eloquent e Form Request, sem Repository Pattern, APIs extras ou abstrações especulativas. |
| **VII. Validação, paginação e testabilidade** | PASS | Todos os campos validados; listagem paginada com `->paginate(10)` e `Paginator::useBootstrapFive()`; cenários testáveis via `FornecedorTest` e `quickstart.md`. |
| **VIII. Nomenclatura e domínio** | PASS | Domínio em português (`Fornecedor`, `FornecedorController`, `FornecedorRequest`) e tabela `fornecedor` em português e `snake_case`. |
| **IX. Governança dos requisitos** | PASS | Artefatos alinhados com `CONTEXTO.md`, `Docs/Sprints/README.md` e `INTEGRANTE-3-SPECS-003-007-011.md`. |

**Gate Result**: APROVADO (sem violações pré ou pós-design).

## Project Structure

### Documentation (this feature)

```text
specs/003-fornecedores/
├── spec.md                       # Especificação funcional ($speckit-specify)
├── plan.md                       # Plano de implementação ($speckit-plan)
├── research.md                   # Decisões técnicas da Phase 0 ($speckit-plan)
├── data-model.md                 # Modelo de dados e validações ($speckit-plan)
├── quickstart.md                 # Guia de verificação e testes ($speckit-plan)
├── contracts/
│   └── routes-and-ui.md          # Contratos de rotas web e views Blade ($speckit-plan)
└── checklists/
    └── requirements.md           # Checklist de qualidade da spec
```

### Source Code (repository root)

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── FornecedorController.php
│   └── Requests/
│       └── FornecedorRequest.php
├── Models/
│   └── Fornecedor.php
└── Providers/
    └── AppServiceProvider.php            # Paginator::useBootstrapFive()

database/
├── migrations/
│   └── YYYY_MM_DD_HHMMSS_create_fornecedor_table.php
└── seeders/
    └── FornecedorSeeder.php

resources/
└── views/
    ├── template.blade.php                # Layout base Bootstrap 5 (@yield('conteudo'))
    ├── listagem_fornecedor.blade.php
    └── formulario_fornecedor.blade.php

routes/
└── web.php                               # Grupo middleware('auth') para /fornecedor/*

tests/
└── Feature/
    └── FornecedorTest.php
```

**Structure Decision**: Estrutura monolítica padrão do Laravel 13 na raiz do repositório, mantendo exatamente as pastas e convenções de nomenclatura ensinadas pelo professor (`app/Models`, `app/Http/Controllers`, `app/Http/Requests`, `resources/views`, `database/migrations`, `routes/web.php`, `tests/Feature`).

## Complexity Tracking

> Nenhuma violação da Constituição foi identificada no planejamento pré-Phase 0 ou pós-Phase 1.
