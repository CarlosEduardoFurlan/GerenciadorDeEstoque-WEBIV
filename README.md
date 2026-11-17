# Sistema de Compras e Vendas

Trabalho acadêmico da disciplina **Construção de Páginas Web IV** do curso de **Tecnologia em Sistemas para Internet - IFMS**.

## Tecnologias
- PHP 8.3+
- Laravel 13
- **SQLite**
- Blade
- Bootstrap 5
- Vite
- Laravel Breeze

## Documentação
- [Constitution](.specify/memory/constitution.md)
- [Contexto](Docs/CONTEXTO.md)
- [Roadmap](Docs/Sprints/README.md)
- [Guia dos integrantes](Docs/GUIA-INTEGRANTES-SPECS.md)

## Instalação

```bash
git clone https://github.com/CarlosEduardoFurlan/GerenciadorDeEstoque-WEBIV.git
cd GerenciadorDeEstoque-WEBIV
composer install
```

Crie o `.env` a partir de `.env.example` e gere a chave:

```bash
php artisan key:generate
```

## SQLite

Crie o arquivo local se necessário:

```bash
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan config:clear
php artisan migrate
```

## Frontend

```bash
npm install
npm run dev
```

Em outro terminal:

```bash
php artisan serve
```

## Spec Kit

```bash
uv tool install specify-cli==1.3.2
specify integration status
```

Fluxo:

```text
$speckit-specify → $speckit-clarify → $speckit-plan → $speckit-checklist
→ $speckit-tasks → $speckit-analyze → $speckit-implement → $speckit-converge
```

## Git

```text
feature/spec → development → main
```

## Requisitos transversais

- validação de formulários;
- paginação 10;
- um cadastro com upload;
- autenticação Breeze;
- e-mail por venda;
- relatório de contas a receber.

Consulte o roadmap para a divisão atualizada das Specs 001–012.
