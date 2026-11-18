# Quickstart: Validação de Cadastro de Fornecedores (`003-fornecedores`)

**Branch**: `feature/003-fornecedores` | **Date**: 2026-11-18 | **Spec**: [spec.md](spec.md)

## Pré-requisitos

- PHP 8.3+ e Composer instalados
- Node.js e npm instalados
- Banco de dados SQLite configurado no `.env` (`DB_CONNECTION=sqlite`) e arquivo `database/database.sqlite` existente

## Preparação do Ambiente

1. Instalar dependências e configurar o ambiente (caso ainda não tenha sido feito):

```bash
composer install
npm install
npm run build
```

2. Garantir o arquivo SQLite e executar as migrations:

```bash
touch database/database.sqlite
php artisan migrate
```

3. (Opcional para validação manual de paginação) Popular dados de exemplo com o seeder de fornecedores:

```bash
php artisan db:seed --class=FornecedorSeeder
```

## Execução dos Testes Automatizados

Executar a suíte de testes da feature para validar CRUD, paginação de 10 registros, validações e proteção por autenticação:

```bash
php artisan test --filter=FornecedorTest
```

**Resultado esperado**: Todos os testes passando sem falhas ou testes pulados, cobrindo:
- Redirecionamento de usuários não autenticados ao acessar rotas `/fornecedor/*`
- Listagem ordenada por `nome` paginada de 10 em 10 registros
- Criação de fornecedor válido (`id == 0`) e redirecionamento para `/fornecedor/listar`
- Rejeição de formulário com campos obrigatórios vazios ou e-mail inválido, com erros em sessão e preservação de `old()`
- Carregamento e atualização de fornecedor existente (`id > 0`)
- Retorno `404` ao editar ou excluir identificador inexistente
- Exclusão de fornecedor existente e remoção da listagem

## Verificação Manual Ponta a Ponta

Subir o servidor local (`php artisan serve`) e autenticar-se com um usuário válido (ou usuário criado via seeder/tinker caso a Spec 009 ainda não esteja integrada).

1. **Cenário P1 — Listagem Paginada e Novo Cadastro**:
   - Acessar `http://127.0.0.1:8000/fornecedor/listar`.
   - Confirmar que a listagem exibe no máximo **10 registros por página** ordenados por `nome`, com navegação Bootstrap 5 quando houver mais de 10 registros.
   - Clicar em **Novo Fornecedor** (`/fornecedor/novo`), testar envio vazio e com e-mail inválido; confirmar exibição das mensagens de erro em português e preservação dos campos preenchidos.
   - Preencher `nome`, `documento`, `email`, `endereco` e `telefone` válidos e clicar em **Salvar**; confirmar redirecionamento para `/fornecedor/listar` e presença do novo fornecedor.
2. **Cenário P2 — Edição de Fornecedor**:
   - Na listagem, clicar em **Editar** em um fornecedor existente (`/fornecedor/editar/{id}`).
   - Verificar que o formulário abre com `id` (somente leitura) e todos os campos preenchidos com os dados atuais.
   - Alterar dados, submeter primeiro com erro (ex.: apagar `nome`) para conferir a preservação dos valores digitados e, em seguida, salvar com dados válidos; confirmar atualização na listagem sem duplicar o registro.
3. **Cenário P3 — Exclusão de Fornecedor**:
   - Na listagem, acionar **Excluir** em um fornecedor de teste (`/fornecedor/excluir/{id}`).
   - Confirmar redirecionamento para `/fornecedor/listar` e ausência do registro excluído.
4. **Proteção de Acesso**:
   - Em uma sessão não autenticada (aba anônima ou após logout), acessar `/fornecedor/listar` e confirmar o redirecionamento para a rota de login.

## Referências

- Requisitos e critérios de aceitação: [spec.md](spec.md)
- Estrutura de tabela e regras de validação: [data-model.md](data-model.md)
- Rotas e contratos das views: [contracts/routes-and-ui.md](contracts/routes-and-ui.md)
