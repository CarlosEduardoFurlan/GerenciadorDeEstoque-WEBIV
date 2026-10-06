# Sistema de Controle de Estoque

Trabalho acadêmico da disciplina **Construção de Páginas Web IV** do curso de **Tecnologia em Sistemas para Internet - IFMS**.

## Tecnologias

- PHP 8.3+
- Laravel 13
- PostgreSQL
- Laravel Blade
- Bootstrap 5
- Vite
- JavaScript apenas quando necessário

## Documentação do projeto

A documentação de referência do projeto está em:

- `Docs/CONTEXTO.md`
- `Docs/DER.jpg`

O DER documentado é o modelo oficial do projeto.

## Requisitos

Antes de executar o projeto, instale:

- PHP 8.3 ou superior
- Composer
- PostgreSQL
- Node.js
- npm

## Instalação

Clone o repositório:

```bash
git clone https://github.com/CarlosEduardoFurlan/GerenciadorDeEstoque-WEBIV.git
cd GerenciadorDeEstoque-WEBIV
```

Instale as dependências PHP:

```bash
composer install
```

Crie o arquivo de ambiente a partir do exemplo.

Linux/macOS:

```bash
cp .env.example .env
```

Windows (Prompt de Comando):

```cmd
copy .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

## Banco de dados

Crie no PostgreSQL um banco vazio chamado:

```text
controle_estoque
```

O `.env.example` já está preparado para PostgreSQL. No seu arquivo `.env`, ajuste apenas as credenciais locais quando necessário:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=controle_estoque
DB_USERNAME=postgres
DB_PASSWORD=SUA_SENHA_LOCAL
```

As tabelas do sistema devem ser criadas por migrations do Laravel, não manualmente pelo pgAdmin.

Limpe o cache de configuração e execute as migrations:

```bash
php artisan config:clear
php artisan migrate
```

## Frontend

Instale as dependências:

```bash
npm install
```

Durante o desenvolvimento, execute:

```bash
npm run dev
```

## Executar a aplicação

Em outro terminal:

```bash
php artisan serve
```

A aplicação ficará disponível em:

```text
http://127.0.0.1:8000
```

## Verificação da Sprint 0

Antes de iniciar o desenvolvimento das funcionalidades, cada integrante deve conseguir:

1. clonar o repositório;
2. executar `composer install`;
3. criar e configurar o próprio `.env`;
4. conectar ao PostgreSQL local;
5. executar `php artisan migrate` sem erros;
6. executar `npm install` e `npm run dev`;
7. executar `php artisan serve`;
8. abrir a aplicação em `http://127.0.0.1:8000`;
9. criar uma branch própria e realizar push.

## Fluxo de Git

A branch `main` representa a versão estável do projeto.

As tarefas devem ser desenvolvidas em branches próprias, por exemplo:

```text
feature/crud-produtos
feature/orcamento-compra
fix/validacao-produto
```

Antes de iniciar uma nova tarefa:

```bash
git checkout main
git pull origin main
git checkout -b feature/nome-da-tarefa
```

Ao finalizar:

```bash
git add .
git commit -m "feat: descricao da tarefa"
git push -u origin feature/nome-da-tarefa
```

Depois, abra um Pull Request para revisão antes do merge.
