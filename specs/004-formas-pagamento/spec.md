# Feature Specification: Formas de Pagamento

**Feature Branch**: `feature/004-formas-pagamento`

**Created**: 2026-11-19

**Status**: Draft — aguardando clarificações do professor

**Input**: User description: "Gerenciar formas de pagamento com descrição, número de parcelas e seus itens, compostos por porcentagem e dia inteiro."

## Clarifications

### Session 2026-11-19

- Q: O que o campo inteiro `dia` de cada item da forma de pagamento representa? → A: Quantidade de dias após a data da compra ou venda.
- Q: A quantidade de itens deve ser exatamente igual ao valor de `numero_parcelas`? → A: Sim, deve existir exatamente um item por parcela.
- Q: A soma das porcentagens de todos os itens deve ser obrigatoriamente igual a 100%? → A: Sim, a soma deve ser exatamente 100%.

## User Scenarios & Testing *(mandatory)*

### User Story 1 - Cadastrar forma de pagamento (Priority: P1)

Como usuário autenticado, quero cadastrar uma forma de pagamento com sua descrição, número de parcelas e itens para que ela possa ser utilizada posteriormente nas operações de compra e venda.

**Why this priority**: O cadastro é a base da funcionalidade e torna as formas de pagamento disponíveis para as demais partes do sistema.

**Independent Test**: Pode ser testado preenchendo os dados de uma nova forma de pagamento e verificando que a forma e todos os seus itens ficam disponíveis para consulta.

**Acceptance Scenarios**:

1. **Given** que o usuário está no cadastro de forma de pagamento, **When** informa dados válidos da forma e de seus itens e confirma a operação, **Then** o sistema registra a forma de pagamento com seus respectivos itens e exibe uma mensagem de sucesso.
2. **Given** que o formulário contém dados ausentes ou incompatíveis com os formatos confirmados, **When** o usuário tenta salvar, **Then** o sistema não registra dados parciais, apresenta os erros de validação e preserva os valores informados para correção.

---

### User Story 2 - Consultar formas de pagamento (Priority: P2)

Como usuário autenticado, quero consultar as formas de pagamento cadastradas e visualizar seus itens para identificar as condições disponíveis.

**Why this priority**: A consulta permite conferir e localizar os cadastros que serão mantidos e utilizados em outras funcionalidades.

**Independent Test**: Pode ser testado cadastrando mais de dez formas, acessando a listagem paginada e abrindo uma delas para conferir todos os seus dados e itens.

**Acceptance Scenarios**:

1. **Given** que existem formas de pagamento cadastradas, **When** o usuário acessa a listagem, **Then** o sistema apresenta no máximo dez formas por página e oferece navegação entre as páginas.
2. **Given** que uma forma de pagamento está cadastrada, **When** o usuário solicita sua visualização, **Then** o sistema apresenta descrição, número de parcelas e a lista de itens com porcentagem e dia.
3. **Given** que não existem formas cadastradas, **When** o usuário acessa a listagem, **Then** o sistema informa que nenhum registro foi encontrado sem apresentar erro.

---

### User Story 3 - Alterar forma de pagamento (Priority: P3)

Como usuário autenticado, quero alterar os dados e os itens de uma forma de pagamento para manter suas condições atualizadas.

**Why this priority**: A manutenção evita que erros ou condições desatualizadas permaneçam no cadastro.

**Independent Test**: Pode ser testado editando uma forma existente, alterando seus dados e sua coleção de itens e verificando que a consulta passa a exibir somente os valores confirmados.

**Acceptance Scenarios**:

1. **Given** que uma forma de pagamento está cadastrada, **When** o usuário envia alterações válidas, **Then** o sistema atualiza a forma e seus itens e exibe uma mensagem de sucesso.
2. **Given** que a alteração contém dados inválidos, **When** o usuário tenta salvar, **Then** o sistema mantém o cadastro anterior intacto, apresenta os erros e preserva os valores preenchidos para correção.

---

### User Story 4 - Excluir forma de pagamento (Priority: P4)

Como usuário autenticado, quero excluir uma forma de pagamento que não deva mais permanecer cadastrada para manter a lista organizada.

**Why this priority**: A exclusão completa o gerenciamento do cadastro, mas depende primeiro da existência e consulta dos registros.

**Independent Test**: Pode ser testado excluindo uma forma de pagamento de teste e verificando que ela e seus itens deixam de aparecer nas consultas.

**Acceptance Scenarios**:

1. **Given** que uma forma de pagamento está cadastrada, **When** o usuário confirma sua exclusão, **Then** o sistema remove a forma e seus itens e exibe uma mensagem de sucesso.

### Edge Cases

- Uma falha de validação não pode gravar apenas parte da forma ou de seus itens.
- Uma alteração de itens não pode deixar dados parcialmente atualizados quando a operação falhar.
- A listagem deve continuar limitada a dez registros por página mesmo quando houver mais registros.
- A quantidade de itens deve corresponder ao número de parcelas e o total das porcentagens deve ser validado antes de salvar.

## Requirements *(mandatory)*

### Functional Requirements

- **FR-001**: O sistema DEVE permitir a usuários autenticados cadastrar uma forma de pagamento informando descrição, número de parcelas e seus itens.
- **FR-002**: Cada item da forma de pagamento DEVE conter uma porcentagem e um dia representado por número inteiro.
- **FR-003**: O campo `dia` de cada item DEVE representar a quantidade de dias após a data da compra ou venda.
- **FR-004**: A quantidade de itens DEVE ser exatamente igual ao valor de `numero_parcelas`, existindo um item para cada parcela.
- **FR-005**: A soma das porcentagens de todos os itens DEVE ser exatamente 100%.
- **FR-006**: O sistema DEVE validar no envio do formulário todos os campos, formatos e regras confirmados nos requisitos, incluindo as três decisões registradas em Clarifications.
- **FR-007**: Quando houver erro de validação, o sistema DEVE informar os problemas ao usuário, preservar os dados preenchidos para correção e não persistir dados parciais.
- **FR-008**: O sistema DEVE listar as formas de pagamento com paginação de dez registros.
- **FR-009**: O sistema DEVE permitir visualizar uma forma de pagamento com sua descrição, número de parcelas e todos os seus itens.
- **FR-010**: O sistema DEVE permitir alterar os dados da forma de pagamento e manipular seus itens, respeitando somente as regras efetivamente confirmadas.
- **FR-011**: O sistema DEVE permitir excluir uma forma de pagamento juntamente com seus itens após confirmação do usuário.
- **FR-012**: O sistema DEVE apresentar mensagens claras de sucesso e de erro nas operações de gerenciamento.
- **FR-013**: O acesso ao gerenciamento DEVE utilizar a autenticação já disponível no projeto; esta feature não deve criar ou substituir o mecanismo de autenticação.
- **FR-014**: O escopo desta feature DEVE permanecer restrito ao gerenciamento de formas de pagamento e de seus itens, sem implementar compras, vendas, contas, estoque, clientes, fornecedores, produtos ou autenticação.

### Key Entities *(include if feature involves data)*

- **Forma de Pagamento**: Condição de pagamento identificada por uma descrição e um número de parcelas; reúne um ou mais itens de pagamento.
- **Item da Forma de Pagamento**: Parte vinculada a uma única forma de pagamento, caracterizada por porcentagem e pela quantidade inteira de dias após a data da compra ou venda.

## Success Criteria *(mandatory)*

### Measurable Outcomes

- **SC-001**: Um usuário consegue cadastrar uma forma de pagamento válida com seus itens em até três minutos.
- **SC-002**: Em todos os cenários de dados inválidos confirmados, o sistema rejeita a operação sem salvar dados parciais e apresenta os erros correspondentes.
- **SC-003**: A listagem nunca apresenta mais de dez formas de pagamento por página e permite alcançar todos os registros cadastrados.
- **SC-004**: Após cadastro, alteração ou exclusão bem-sucedidos, 100% dos dados exibidos na consulta refletem a última operação confirmada.
- **SC-005**: Todos os cenários de aceitação da Spec 004 podem ser concluídos sem incluir funcionalidades de outras Specs.

## Assumptions

- O gerenciamento é realizado por usuários autenticados por meio do mecanismo que já estiver integrado ao projeto.
- A forma de pagamento possui uma coleção de itens, cada item pertence a uma única forma de pagamento e deve existir exatamente um item para cada parcela.
- A descrição identifica a condição para o usuário, sem pressupor uma regra de unicidade que não foi definida pelo professor.
- Compras e vendas apenas utilizarão este cadastro em Specs próprias e não fazem parte desta feature.
- A validação deve considerar a soma exata das porcentagens de todos os itens da forma de pagamento.

