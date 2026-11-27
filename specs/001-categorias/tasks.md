# Tasks: Categorias

**Input**: [spec.md](spec.md), [plan.md](plan.md), [data-model.md](data-model.md)

## Fundação

- [x] T001 Criar migration `categoria` com descrição, margem decimal e índice em `database/migrations/`.
- [x] T002 Criar model `Categoria` em `app/Models/Categoria.php`.
- [x] T003 Criar `CategoriaRequest` com validação de descrição e margem em `app/Http/Requests/`.

## Cadastro e consulta

- [x] T004 Criar rotas protegidas e controller CRUD em `routes/web.php` e `app/Http/Controllers/CategoriaController.php`.
- [x] T005 Criar formulários Bootstrap e listagem paginada em `resources/views/categorias/`.
- [x] T006 Testar cadastro, validação, estado vazio, paginação e proteção em `tests/Feature/CategoriaTest.php`.

## Atualização e exclusão

- [x] T007 Implementar cálculo em centavos e recálculo transacional em `app/Services/AtualizarMargemCategoria.php`.
- [x] T008 Impedir exclusão com produtos vinculados e testar margem, rollback em falha de banco, isolamento entre categorias, edição de descrição e exclusão.

## Convergência

- [ ] T009 Rodar testes e quickstart; conferir contrato de `produto` quando a Spec 002 estiver integrada. Suíte atual: 33 testes e 193 assertions; integração real depende da 002.
- [ ] T010 Revisar diff e abrir PR para `development` após gates concluídos.

**Dependência**: A validação real com produto depende da Spec 002. A autenticação definitiva depende da integração da Spec 009.
