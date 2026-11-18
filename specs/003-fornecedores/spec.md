# Feature Specification: Cadastro de Fornecedores

**Feature Branch**: `feature/003-fornecedores`

**Created**: 2026-11-18

**Status**: Draft

**Input**: User description: "Sprint 1 — 003 Fornecedores: CRUD de fornecedores com id, nome, documento, email, endereco e telefone, validação de formulário e paginação de 10 registros por página."

## User Scenarios & Testing *(mandatory)*

### User Story 1 - Cadastrar e Listar Fornecedores (Priority: P1)

Como usuário autenticado do sistema, quero cadastrar novos fornecedores informando seus dados de contato e identificação (`nome`, `documento`, `email`, `endereco` e `telefone`) e visualizar a lista paginada de fornecedores cadastrados para manter a base de fornecedores pronta para futuras compras e contas a pagar.

**Why this priority**: Sem o cadastro e a listagem de fornecedores, não é possível registrar fornecedores no sistema nem consultar os registros disponíveis para operações de compra nas etapas seguintes.

**Independent Test**: Pode ser testado de forma independente acessando a listagem de fornecedores, abrindo o formulário de novo cadastro, preenchendo todos os campos válidos, salvando e verificando a exibição do registro na listagem ordenada por nome e paginada de 10 em 10 registros.

**Acceptance Scenarios**:

1. **Given** que o usuário está autenticado e acessa a tela de listagem de fornecedores, **When** existem fornecedores cadastrados, **Then** o sistema exibe os registros ordenados alfabeticamente por `nome`, limitados a no máximo 10 registros por página, com controles de navegação entre páginas.
2. **Given** que o usuário está no formulário de cadastro de fornecedor, **When** preenche `nome`, `documento`, `email`, `endereco` e `telefone` com dados válidos e confirma o envio, **Then** o fornecedor é salvo com um identificador único (`id`) gerado automaticamente e o usuário é redirecionado para a listagem de fornecedores onde o novo registro aparece.
3. **Given** que o usuário está no formulário de cadastro de fornecedor, **When** envia o formulário com algum campo obrigatório vazio ou com `email` em formato inválido, **Then** o sistema não grava o registro, exibe as mensagens de erro em português e mantém os valores preenchidos nos campos do formulário.

---

### User Story 2 - Editar Dados de Fornecedor (Priority: P2)

Como usuário autenticado do sistema, quero selecionar um fornecedor existente na listagem e alterar seus dados cadastrais com validação para manter as informações de contato e documentação sempre atualizadas.

**Why this priority**: Dados comerciais e de contato dos fornecedores mudam ao longo do tempo e erros de digitação precisam ser corrigidos sem perder o histórico ou recriar o registro.

**Independent Test**: Pode ser testado de forma independente selecionando a ação de edição em um fornecedor existente na listagem, modificando campos no formulário preenchido com os dados atuais, salvando e verificando os dados atualizados na listagem.

**Acceptance Scenarios**:

1. **Given** que o usuário está autenticado na listagem de fornecedores, **When** aciona a opção de editar um fornecedor existente, **Then** o sistema abre o formulário preenchido com os dados atuais desse fornecedor (`id`, `nome`, `documento`, `email`, `endereco`, `telefone`).
2. **Given** que o usuário está editando um fornecedor existente, **When** altera um ou mais campos com valores válidos e confirma o envio, **Then** o registro existente é atualizado sem criar duplicidade e o usuário retorna à listagem exibindo os dados atualizados.
3. **Given** que o usuário está editando um fornecedor existente, **When** limpa um campo obrigatório ou informa um `email` inválido e tenta salvar, **Then** a alteração é rejeitada, as mensagens de erro são exibidas em português e os valores digitados permanecem visíveis no formulário.

---

### User Story 3 - Excluir Fornecedor (Priority: P3)

Como usuário autenticado do sistema, quero excluir um fornecedor cadastrado que não possua vínculos impeditivos para remover registros incorretos ou que não são mais utilizados.

**Why this priority**: Permite a manutenção e limpeza da base cadastral após o cadastro e a atualização estarem disponíveis.

**Independent Test**: Pode ser testado de forma independente acionando a opção de exclusão de um fornecedor sem vínculos na listagem e confirmando que o registro deixa de aparecer na listagem.

**Acceptance Scenarios**:

1. **Given** que o usuário está autenticado na listagem de fornecedores e existe um fornecedor sem vínculos impeditivos, **When** aciona a opção de excluir esse fornecedor, **Then** o fornecedor é removido do sistema e o usuário é redirecionado para a listagem atualizada sem o registro excluído.

---

### Edge Cases

- **Submissão com campos obrigatórios vazios**: Todos os campos (`nome`, `documento`, `email`, `endereco`, `telefone`) são obrigatórios; o sistema rejeita envios parciais e informa cada campo inválido em português.
- **Formato de e-mail inválido**: E-mails malformados (sem `@` ou domínio inválido) devem ser rejeitados com mensagem clara em português e preservação dos dados informados.
- **Listagem vazia**: Quando não há fornecedores cadastrados, a página de listagem deve ser exibida normalmente com a tabela vazia e a ação para cadastrar o primeiro fornecedor.
- **Paginação com mais de 10 registros**: Quando houver 11 ou mais fornecedores, a primeira página exibe exatamente 10 registros ordenados por nome e os demais ficam acessíveis nas páginas seguintes.
- **Acesso por usuário não autenticado**: Tentativas de acessar listagem, criação, salvamento, edição ou exclusão sem sessão autenticada devem redirecionar o usuário para a tela de login.
- **Identificador inexistente na edição ou exclusão**: Ao tentar editar ou excluir um identificador que não existe, o sistema deve impedir falha não tratada e retornar erro apropriado de recurso não encontrado.
- **Fornecedor com vínculos futuros**: Quando módulos de compras (Spec 005) e contas a pagar (Spec 007) forem integrados na Sprint 2, a exclusão de um fornecedor vinculado deve respeitar a integridade referencial e não deixar registros órfãos.

## Requirements *(mandatory)*

### Functional Requirements

- **FR-001**: O sistema DEVE permitir listar os fornecedores cadastrados com paginação de exatamente 10 registros por página, ordenados alfabeticamente pelo campo `nome`.
- **FR-002**: O sistema DEVE permitir cadastrar um novo fornecedor contendo os atributos: `id` (identificador único gerado automaticamente), `nome`, `documento`, `email`, `endereco` e `telefone`.
- **FR-003**: O sistema DEVE permitir visualizar os dados atuais e editar os campos (`nome`, `documento`, `email`, `endereco`, `telefone`) de um fornecedor existente a partir de seu identificador.
- **FR-004**: O sistema DEVE permitir excluir um fornecedor existente a partir de seu identificador.
- **FR-005**: O sistema DEVE validar todos os campos do formulário antes de persistir os dados, exigindo preenchimento obrigatório de `nome`, `documento`, `email`, `endereco` e `telefone`, bem como formato válido para `email`.
- **FR-006**: O sistema DEVE exibir mensagens de erro de validação claras em português quando o envio for inválido e preservar os valores preenchidos pelo usuário no formulário.
- **FR-007**: O sistema DEVE restringir todas as operações de listagem, criação, edição, salvamento e exclusão de fornecedores a usuários autenticados, integrando-se à funcionalidade de Autenticação (Spec 009).

### Key Entities

- **Fornecedor**: Representa a pessoa física ou jurídica responsável pelo fornecimento de produtos no processo de compras. Atributos principais: `id`, `nome`, `documento`, `email`, `endereco`, `telefone`. Relaciona-se futuramente com `Compra` (Spec 005) e `ContaPagar` (Spec 007).

## Success Criteria *(mandatory)*

### Measurable Outcomes

- **SC-001**: Usuários autenticados conseguem cadastrar um novo fornecedor ou editar um fornecedor existente em menos de 1 minuto.
- **SC-002**: 100% das submissões de formulário com campos obrigatórios ausentes ou e-mail inválido são bloqueadas antes da gravação, exibindo mensagens de erro em português e mantendo os valores informados no formulário.
- **SC-003**: A listagem de fornecedores exibe no máximo 10 registros por página e permite navegar entre páginas mantendo a ordenação por nome.
- **SC-004**: 100% das rotas de fornecedores exigem autenticação prévia, bloqueando acessos anônimos antes da execução de qualquer operação de leitura ou escrita.

## Assumptions

- Todos os cinco campos cadastrais (`nome`, `documento`, `email`, `endereco`, `telefone`) são obrigatórios conforme o modelo de domínio definido para o projeto.
- O campo `documento` aceita CPF ou CNPJ em formato texto (com ou sem pontuação), validando presença e limite de caracteres adequado.
- A proteção de acesso por autenticação será aplicada de forma compatível com a Spec 009 — Autenticação.
- Na Sprint 1 ainda não existem registros de Compra (Spec 005) nem de Contas a Pagar (Spec 007); quando essas funcionalidades forem integradas na Sprint 2, as chaves estrangeiras e regras de integridade protegerão fornecedores vinculados contra exclusão inconsistente.
