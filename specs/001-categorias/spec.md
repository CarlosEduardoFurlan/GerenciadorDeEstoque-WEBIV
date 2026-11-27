# Feature Specification: Categorias

**Feature Branch**: `feature/001-categorias`
**Created**: 2026-11-26
**Status**: Clarificada
**Input**: Sprint 1 do integrante 1: cadastro de categorias com descrição e margem, recálculo de preço dos produtos da categoria.

## Clarifications

### Session 2026-11-26

- Q: Como a margem deve compor o preço de venda? → A: Valor de compra do produto acrescido da margem percentual da categoria; R$ 100 com 30% resulta em R$ 130.

## User Scenarios & Testing *(mandatory)*

### User Story 1 - Cadastrar categoria (Priority: P1)

Como usuário autenticado, quero cadastrar a descrição e a margem de lucro de uma categoria para organizar os produtos.

**Why this priority**: Produtos dependem de uma categoria cadastrada.

**Independent Test**: Cadastrar uma categoria e consultá-la na listagem.

**Acceptance Scenarios**:

1. **Given** dados válidos, **When** salvo uma categoria, **Then** ela aparece na listagem com descrição e margem.
2. **Given** descrição vazia ou margem inválida, **When** tento salvar, **Then** recebo mensagens e nenhum registro é criado.

### User Story 2 - Consultar categorias (Priority: P2)

Como usuário autenticado, quero localizar categorias e consultar suas margens.

**Independent Test**: Cadastrar onze categorias e navegar entre páginas da listagem.

**Acceptance Scenarios**:

1. **Given** mais de dez categorias, **When** consulto a listagem, **Then** vejo no máximo dez por página e navegação para os demais registros.
2. **Given** nenhuma categoria, **When** abro a listagem, **Then** vejo um estado vazio claro.

### User Story 3 - Alterar categoria (Priority: P3)

Como usuário autenticado, quero corrigir a descrição e a margem; ao mudar a margem, quero que os preços de venda de todos os produtos vinculados sejam atualizados.

**Independent Test**: Vincular produtos com custos diferentes, mudar a margem e conferir todos os preços resultantes.

**Acceptance Scenarios**:

1. **Given** uma categoria com produtos, **When** altero sua margem, **Then** cada produto da categoria recebe preço de venda recalculado conforme seu custo e a nova margem.
2. **Given** uma alteração inválida, **When** tento salvar, **Then** nem a categoria nem seus produtos são alterados.
3. **Given** uma alteração apenas da descrição, **When** salvo, **Then** os preços de venda permanecem iguais.

### User Story 4 - Excluir categoria (Priority: P4)

Como usuário autenticado, quero excluir uma categoria sem produtos para manter o cadastro organizado.

**Independent Test**: Excluir categoria sem produtos e tentar excluir outra que possui produtos.

**Acceptance Scenarios**:

1. **Given** uma categoria sem produtos, **When** confirmo a exclusão, **Then** ela desaparece da listagem.
2. **Given** uma categoria com produtos, **When** tento excluí-la, **Then** a exclusão é recusada e os dados permanecem intactos.

### Edge Cases

- A margem deve aceitar zero e rejeitar valores negativos ou percentuais sem sentido.
- O recálculo deve preservar centavos e não alterar produtos de outras categorias.
- Uma falha durante o recálculo não pode salvar só parte das alterações.
- A exclusão não pode deixar produtos sem categoria.

## Requirements *(mandatory)*

### Functional Requirements

- **FR-001**: O sistema DEVE permitir cadastrar, consultar, editar e excluir categorias com descrição e margem de lucro.
- **FR-002**: Todos os formulários DEVEM validar descrição e margem e apresentar erros claros.
- **FR-003**: A listagem DEVE exibir no máximo dez categorias por página.
- **FR-004**: A mudança da margem DEVE atualizar o preço de venda de todos os produtos da categoria: `valor_compra × (1 + margem_lucro / 100)`, arredondado a centavos; R$ 100 com margem de 30% resulta em R$ 130.
- **FR-005**: O recálculo e a mudança de margem DEVEM ocorrer integralmente ou não ocorrer.
- **FR-006**: O sistema DEVE impedir a exclusão de categorias que possuam produtos.
- **FR-007**: Apenas usuários autenticados DEVEM acessar as operações de categoria.

### Key Entities

- **Categoria**: Descrição e margem de lucro, associada a vários produtos.
- **Produto**: Item vinculado a uma categoria, com custo e preço de venda a recalcular.

## Success Criteria *(mandatory)*

### Measurable Outcomes

- **SC-001**: Cada página lista até dez categorias e todas ficam acessíveis por paginação.
- **SC-002**: Após mudar a margem, 100% dos produtos vinculados apresentam o preço correto ao centavo e nenhum produto de outra categoria muda.
- **SC-003**: 100% dos formulários inválidos são rejeitados sem persistência parcial.
- **SC-004**: Uma categoria com produtos nunca é removida pelo fluxo de exclusão.

## Assumptions

- O cadastro de produtos é responsabilidade da Spec 002; a integração de preços precisa seguir o modelo final dessa Spec.
- Não há exigência do professor de unicidade para a descrição da categoria.
- A política de acesso depende da Spec 009.
