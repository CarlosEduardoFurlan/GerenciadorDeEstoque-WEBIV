# Feature Specification: Autenticação

**Feature Branch**: `feature/009-autenticacao`
**Created**: 2026-11-26
**Status**: Clarificada
**Input**: Sprint 1 do integrante 1: autenticação obrigatória com Laravel Breeze e proteção das áreas do sistema.

## Clarifications

### Session 2026-11-26

- Q: O cadastro de usuários será público? → A: Sim, qualquer pessoa poderá criar uma conta na tela de login.

## User Scenarios & Testing *(mandatory)*

### User Story 1 - Entrar no sistema (Priority: P1)

Como usuário cadastrado, quero entrar com meu e-mail e senha para acessar os cadastros do sistema.

**Why this priority**: Os demais cadastros dependem da identificação do usuário.

**Independent Test**: Acessar login, entrar com credenciais válidas e consultar um cadastro protegido.

**Acceptance Scenarios**:

1. **Given** um usuário cadastrado, **When** informa e-mail e senha corretos, **Then** entra na área principal e consegue acessar os cadastros.
2. **Given** uma pessoa sem sessão, **When** acessa diretamente uma página de cadastro, **Then** é redirecionada ao login e, após entrar, retorna à página pretendida.
3. **Given** credenciais incorretas, **When** tenta entrar, **Then** recebe erro sem estabelecer sessão.

### User Story 1A - Criar conta (Priority: P1)

Como visitante, quero criar uma conta pela tela de entrada para começar a usar o sistema.

**Why this priority**: Permite o primeiro acesso sem depender de criação manual de usuários.

**Independent Test**: Registrar nome, e-mail único e senha válida e acessar um cadastro protegido.

**Acceptance Scenarios**:

1. **Given** uma pessoa sem conta, **When** informa nome, e-mail único, senha e confirmação válidos, **Then** sua conta é criada e ela entra na área principal.
2. **Given** e-mail já utilizado ou dados inválidos, **When** tenta se registrar, **Then** recebe erros e nenhuma conta duplicada é criada.

### User Story 2 - Sair do sistema (Priority: P2)

Como usuário autenticado, quero encerrar minha sessão para que outra pessoa não utilize meu acesso.

**Independent Test**: Entrar, sair e tentar abrir uma página protegida novamente.

**Acceptance Scenarios**:

1. **Given** uma sessão ativa, **When** o usuário solicita sair, **Then** a sessão é encerrada e o acesso seguinte exige novo login.

### User Story 3 - Recuperar acesso (Priority: P3)

Como usuário cadastrado, quero solicitar redefinição de senha pelo e-mail associado à conta.

**Independent Test**: Solicitar o link, definir nova senha e entrar com ela.

**Acceptance Scenarios**:

1. **Given** uma conta existente, **When** o usuário solicita a redefinição e segue o link recebido, **Then** pode estabelecer uma nova senha validada.

### Edge Cases

- Uma pessoa sem sessão não consegue executar ações de escrita por URL direta.
- Credenciais incorretas não revelam se uma conta existe.
- Link de recuperação inválido ou expirado não altera a senha.
- Nova senha inválida não altera o cadastro.
- Uma conta com e-mail já cadastrado não pode ser registrada novamente.

## Requirements *(mandatory)*

### Functional Requirements

- **FR-001**: O sistema DEVE autenticar usuários por e-mail e senha.
- **FR-002**: O sistema DEVE proteger páginas e ações de fornecedores e formas de pagamento, bem como as novas áreas de cadastro que forem adicionadas.
- **FR-003**: O sistema DEVE direcionar pessoas não autenticadas ao login e preservar o destino original após a entrada.
- **FR-004**: O sistema DEVE permitir encerrar a sessão com segurança.
- **FR-005**: O sistema DEVE validar os dados enviados nos formulários de autenticação e apresentar erros sem perder os campos não sensíveis.
- **FR-006**: O sistema DEVE permitir solicitar e concluir a recuperação de senha por e-mail.
- **FR-007**: O sistema DEVE permitir cadastro público de usuários pela tela de entrada, com nome, e-mail único, senha e confirmação de senha.
- **FR-008**: O acesso à área principal DEVE exigir autenticação.

### Key Entities

- **Usuário**: Pessoa com nome, e-mail único e senha protegida.
- **Sessão**: Acesso vigente associado a um usuário autenticado.
- **Solicitação de recuperação**: Token temporário associado a um e-mail de usuário.

## Success Criteria *(mandatory)*

### Measurable Outcomes

- **SC-001**: 100% das páginas e ações de cadastro da Sprint 1 exigem autenticação.
- **SC-002**: Um usuário cadastrado com credenciais válidas consegue entrar e sair em menos de dois minutos.
- **SC-003**: Em todos os cenários de credenciais inválidas, o acesso às áreas protegidas continua bloqueado.
- **SC-004**: Um usuário consegue concluir a recuperação com um link válido e entrar usando a nova senha.
- **SC-005**: Uma pessoa sem conta consegue criar uma conta válida e acessar um cadastro protegido em menos de três minutos.

## Assumptions

- Esta feature não cria papéis ou níveis de permissão; usuários autenticados têm acesso aos cadastros existentes.
- O envio de e-mail de recuperação usa a configuração de e-mail do ambiente, cuja entrega externa depende da configuração do projeto.
- O cadastro é público, sem aprovação administrativa.
