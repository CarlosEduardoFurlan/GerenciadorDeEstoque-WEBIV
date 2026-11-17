# Sistema de Compras e Vendas Constitution

## Core Principles

### I. Requisitos do professor como fonte primária

Os requisitos e modelos mais recentes fornecidos pelo professor DEVEM prevalecer sobre decisões anteriores do projeto. Mudanças oficiais DEVEM atualizar primeiro documentação e Specs afetadas, depois Plans, Tasks e código. Regras antigas incompatíveis NÃO DEVEM permanecer ativas.

### II. Spec-Driven Development

Toda funcionalidade relevante DEVE começar por uma Spec. O fluxo padrão é:

```text
specify → clarify → plan → checklist → tasks → analyze → implement → converge
```

A implementação NÃO DEVE começar antes de Spec, Plan e Tasks estarem consistentes e das clarificações críticas estarem resolvidas. Os artefatos DEVEM ficar em `specs/`.

### III. Stack obrigatória e autenticação

O projeto DEVE manter PHP 8.3+, Laravel 13, **SQLite**, Laravel Blade, Bootstrap 5 e Vite. JavaScript DEVE ser usado somente quando necessário. A aplicação DEVE seguir MVC convencional do Laravel, Eloquent ORM, migrations, Form Requests e Services quando houver regra relevante.

A autenticação é obrigatória e DEVE utilizar **Laravel Breeze**.

### IV. Banco de dados e persistência

Toda estrutura do banco DEVE ser criada por migrations do Laravel. O banco obrigatório é SQLite. O Plan/Data Model de cada feature DEVE definir PKs, FKs, constraints e índices necessários.

Valores monetários DEVEM usar tipos decimais adequados; FLOAT é proibido para dinheiro.

### V. Regras de negócio no backend

Regras críticas DEVEM ser validadas no backend. JavaScript pode melhorar a experiência, mas NÃO DEVE ser a única fonte de validação.

Operações de compra e venda que alterem produto, estoque e financeiro DEVEM ser planejadas de forma atômica quando necessário para evitar alterações parciais.

### VI. Simplicidade

Por ser um projeto acadêmico, as decisões DEVEM priorizar clareza, organização, facilidade de explicação e código Laravel convencional. Repository Pattern sem necessidade, APIs desnecessárias, arquiteturas distribuídas e abstrações especulativas DEVEM ser evitados.

### VII. Validação, paginação e testabilidade

Todos os formulários DEVEM ser validados. Listagens DEVEM usar paginação de **10 registros por página**.

Cada Spec DEVE conter critérios de aceitação, cenários de validação e casos de erro. Antes do PR, a feature DEVE executar os testes aplicáveis e validar seu `quickstart.md`.

### VIII. Nomenclatura e domínio

O domínio DEVE permanecer em português, incluindo `Categoria`, `Produto`, `Fornecedor`, `FormaPagamento`, `Compra`, `ContaPagar`, `Cliente`, `Venda` e `ContaReceber`. Tabelas DEVEM usar português e `snake_case`.

### IX. Governança dos requisitos

Quando um requisito mudar, a sequência obrigatória é:

```text
Requisito do professor → Spec → Plan → Tasks → Implementação
```

As Specs são a fonte detalhada de verdade. `Docs/CONTEXTO.md` mantém a visão geral e `Docs/Sprints/README.md` mantém somente o roadmap.

## Requisitos transversais obrigatórios

O detalhamento vigente exige:

- pelo menos um cadastro com upload de arquivo;
- validação de formulários;
- paginação de 10 em 10 registros;
- autenticação com Laravel Breeze;
- e-mail ao cliente a cada venda contendo os dados da venda;
- relatório de contas a receber em período baseado na data da venda, totalizando não pagos vencidos, não pagos a vencer e pagos.

## Limites do escopo atual

O material vigente contém as seções **DE COMPRA** e **DE VENDA**.

A alteração da margem de lucro de uma categoria DEVE atualizar o preço de venda de todos os produtos da categoria.

Ao salvar uma compra, o sistema DEVE atualizar o valor de compra do produto, atualizar a quantidade em estoque e gerar contas a pagar conforme o parcelamento.

Ao registrar uma venda, o sistema DEVE atualizar a quantidade em estoque, gerar contas a receber conforme o parcelamento e enviar e-mail ao cliente.

A exigência anterior de média aritmética para custo NÃO aparece no detalhamento vigente e não deve permanecer como requisito ativo.

## Fluxo e critérios de revisão

Cada integrante DEVE executar, uma etapa por vez:

```text
$speckit-specify
$speckit-clarify
$speckit-plan
$speckit-checklist
$speckit-tasks
$speckit-analyze
$speckit-implement
$speckit-converge
```

Antes da implementação, verificar requisito vigente, clarificações e consistência entre Spec/Plan/Tasks. Antes da integração, verificar testes, quickstart e convergência.

## Governance

Esta Constituição rege o processo do projeto. A versão segue SemVer: MAJOR para remoção ou redefinição incompatível de princípios/restrições; MINOR para ampliação material compatível; PATCH para correções sem mudança de significado.

A versão 2.0.0 é MAJOR porque substitui PostgreSQL por SQLite como banco obrigatório e amplia o escopo ativo para vendas, autenticação, contas a receber, e-mail e relatório.

**Version**: 2.0.0 | **Ratified**: 2026-11-07 | **Last Amended**: 2026-11-17
