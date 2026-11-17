# Instruções do projeto

## Fontes e processo

- Ler `.specify/memory/constitution.md`, `Docs/CONTEXTO.md`, `Docs/Sprints/README.md` e `Docs/GUIA-INTEGRANTES-SPECS.md`.
- Os requisitos mais recentes do professor têm prioridade e agora incluem **DE COMPRA**, **DE VENDA** e requisitos transversais.
- Seguir Spec Kit: specify → clarify → plan → checklist → tasks → analyze → implement → converge.
- Cada feature parte de `development` e gera PR para `development`.

## Stack e convenções

- PHP 8.3+, Laravel 13, **SQLite**, Blade, Bootstrap 5 e Vite.
- Autenticação obrigatória com Laravel Breeze.
- Seguir MVC, Eloquent, migrations, Form Requests e Services quando necessário.
- Todos os formulários devem ser validados.
- Listagens devem paginar 10 registros.
- Pelo menos um cadastro deve possuir upload de arquivo; o roadmap aloca esse requisito à Spec 002.
- Não instalar Laravel Boost.

## Compra e venda

- Alterar margem de categoria atualiza preço de venda dos produtos da categoria.
- Compra atualiza valor de compra e estoque e gera contas a pagar conforme parcelamento.
- Contas a pagar possuem situação e baixa.
- Venda atualiza estoque e gera contas a receber conforme parcelamento.
- Cada venda envia e-mail ao cliente com os dados da venda.
- Contas a receber possuem baixa e relatório por período com totais de não pagos vencidos, não pagos a vencer e pagos.

## Verificação e Git

- Consultar `git status` antes de editar.
- Executar testes aplicáveis antes do PR.
- Não versionar `.env`, credenciais ou `.specify/feature.json`.
- Features entram em `development` por PR; `main` recebe somente versões consolidadas.
