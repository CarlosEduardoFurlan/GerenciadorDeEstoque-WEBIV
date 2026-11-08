# Sistema de Compras e Vendas

Trabalho acadêmico da disciplina **Construção de Páginas Web IV** do curso de **Tecnologia em Sistemas para Internet - IFMS**.

Repositório `GerenciadorDeEstoque-WEBIV`. O material atualizado do professor é
**Projeto Sistema Compras e Vendas**, seção **DE COMPRA**. Contas a pagar fazem parte
do escopo. A parte de vendas está **AGUARDANDO REQUISITOS ATUALIZADOS DO PROFESSOR**.

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

- [Constitution](.specify/memory/constitution.md): princípios e governança.
- [Contexto](Docs/CONTEXTO.md): visão geral, estado atual e pontos de clarificação.
- [Roadmap de Sprints](Docs/Sprints/README.md): temas, dependências e responsáveis.
- [Registro da adoção](Docs/ADOCAO-SPEC-KIT.md): estado do processo e reorganização documental.
- `specs/`: futuras especificações detalhadas das features, fonte detalhada de verdade.

Os requisitos atualizados do professor têm prioridade. Não existe DER definitivo neste
momento: ainda há requisitos aguardando clarificação. O material de planejamento antigo
foi removido da árvore do projeto. As Specs 001–008 continuam reservadas para criação futura.

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

## Verificação do ambiente de cada integrante

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

## Desenvolvimento com Spec Kit

O projeto já foi inicializado com **GitHub Spec Kit**, integração oficial **`codex`**,
Specify CLI **1.3.2**, scripts PowerShell e skills em `.agents/skills/`. Os arquivos
compartilháveis de `.specify/` e as skills devem acompanhar o repositório; cada integrante
instala as ferramentas na própria máquina. Não é necessário executar `specify init`
novamente após clonar.

Requisitos adicionais: **Python 3.11+**, **uv** e **Specify CLI**. Instale uv seguindo a
[documentação oficial](https://docs.astral.sh/uv/getting-started/installation/).
Se não houver Python compatível, uv pode instalá-lo, por exemplo:

```bash
uv python install 3.13
```

Instale a CLI oficial:

```bash
uv tool install specify-cli
```

Para reproduzir a versão usada nesta adoção, utilize `uv tool install specify-cli==1.3.2`
em vez do comando sem versão. Reinicie o terminal se o diretório de executáveis do uv
ainda não estiver no PATH. O Python instalado pelo uv também pode ser verificado com
`uv run --no-project --python 3.13 python --version` se o comando `python` do Windows
ainda apontar para o atalho da Microsoft Store.

Na raiz do projeto, verifique:

```bash
python --version
uv --version
specify --version
specify check
specify integration status
```

A integração deve indicar `codex`, sem arquivos gerenciados ausentes ou modificados.
O comando de inicialização usado nesta adoção foi:

```bash
specify init --here --force --integration codex --script ps --non-interactive
```

`--here` utiliza o projeto existente; `--force` permite mesclar os templates nesse
diretório; `--script ps` seleciona PowerShell e `--non-interactive` evita perguntas
interativas durante a preparação automatizada. Esse registro não é uma etapa a repetir
em cada clone. As referências oficiais estão no [GitHub Spec Kit](https://github.com/github/spec-kit).

Abra o Codex na raiz do projeto. As skills devem ser executadas **no chat do Codex**,
uma por vez, revisando o resultado; não são comandos de terminal:

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

A [Constitution](.specify/memory/constitution.md), criada com `$speckit-constitution`,
rege esse fluxo. Spec, Plan e Tasks devem estar consistentes antes da implementação.
As dez ambiguidades do [contexto](Docs/CONTEXTO.md) devem ser levadas às Specs pertinentes
e a Clarify/professor; não presumir a fórmula da média, gatilhos de estoque/preços nem
geração de contas a pagar.

Cada feature futura terá sua documentação em `specs/<numero>-<tema>/`: `spec.md`,
`plan.md`, `tasks.md`, `checklists/`, `data-model.md`, `quickstart.md` e `research.md`,
conforme o fluxo. As tarefas não serão duplicadas em `Docs/Sprints/`. O
[roadmap](Docs/Sprints/README.md) detalha esses artefatos e reserva 001–008 por integrante;
essas Specs serão criadas posteriormente, começando pela Sprint 1. Não criar Specs 009+
enquanto vendas aguarda os requisitos atualizados.

Versionar Constitution, templates, scripts, manifests e skills compartilháveis.
O estado local `.specify/feature.json` é ignorado por `.specify/.gitignore`; `.codex/`,
credenciais e demais dados locais de agentes não devem ser versionados.

Laravel Boost não faz parte da stack e não é necessário para o Spec Kit ou sua integração
Codex. A auditoria da adoção removeu sua inclusão inicial e restaurou `composer.json` e
`composer.lock` ao estado anterior, sem alterar outras dependências. As instruções
Laravel/PostgreSQL/npm acima continuam válidas e não há implementação de negócio nesta Sprint 0.

## Fluxo de Git

A branch `development` recebe a integração das features. A `main` fica reservada
a versões estáveis e consolidadas:

```text
feature/spec → development → main
```

Cada integrante deve partir da `development` atualizada e criar uma branch por Spec:

```bash
git checkout development
git pull origin development
git checkout -b feature/001-categorias
```

Os outros nomes reservados para a Sprint 1 são `feature/002-produtos`,
`feature/003-fornecedores` e `feature/004-formas-pagamento`. No Codex, informar o
`SPECIFY_FEATURE_DIRECTORY` correspondente ao executar `$speckit-specify`, sem depender
da numeração automática. Esse processo será executado futuramente, não nesta reorganização.

Cada feature deve gerar um PR independente para `development`, nunca diretamente para
`main`. Somente versões consolidadas seguem de `development` para `main`. Para atualizar
uma feature com dependências já integradas, o grupo recomenda merge de `development`
para a feature, por simplicidade acadêmica. O [roadmap](Docs/Sprints/README.md) e os
quatro arquivos por integrante detalham o fluxo e a prevenção de conflitos.
