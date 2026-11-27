# Implementation Plan: Categorias

**Branch**: `feature/001-categorias` | **Date**: 2026-11-26 | **Spec**: [spec.md](spec.md)

## Summary

Adicionar CRUD de categorias, validação e paginação de dez. Alterar a margem recalcula os preços de venda dos produtos vinculados em uma única transação, usando centavos inteiros e o contrato da futura Spec 002.

## Technical Context

- PHP 8.3+, Laravel 13, Eloquent, SQLite, Blade, Bootstrap 5, Vite.
- PHPUnit Feature com SQLite em memória. Aplicação MVC existente.
- Dinheiro em decimal(12,2), margem em decimal(7,2); cálculo inteiro de centavos.
- A tabela de produtos ainda não existe na `development`; esta Spec não a cria.

## Constitution Check

| Regra | Decisão |
|---|---|
| Especificar antes de implementar | Spec clarificada e tarefas definidas |
| Português, migrations, SQLite | Tabela `categoria`, model `Categoria`, migration |
| Sem float para dinheiro | Centavos inteiros, persistência decimal |
| Transação em regra crítica | Margem e preços atualizados atomicamente |
| Formulários validados, paginação dez, autenticação | Form Request, `paginate(10)`, middleware `auth` |
| Uma branch e PR para development | Branch 001 isolada; PR após integração e validação |

## Project Structure

```text
app/Http/Controllers/CategoriaController.php
app/Http/Requests/CategoriaRequest.php
app/Models/Categoria.php
app/Services/AtualizarMargemCategoria.php
database/migrations/*_create_categoria_table.php
resources/views/categorias/{index,form}.blade.php
routes/web.php
tests/Feature/CategoriaTest.php
specs/001-categorias/{spec,plan,research,data-model,quickstart,tasks}.md
```

**Structure Decision**: CRUD MVC simples; Service apenas para regra transacional de margem e preços. Contrato de `produto` reservado à 002.
