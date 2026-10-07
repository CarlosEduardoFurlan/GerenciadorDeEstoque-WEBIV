# Integrante 2 — Sprints 02 e 06

Responsabilidade principal: **layout, CRUDs, validações e qualidade da interface**.

---

# Sprint 02 — Layout e CRUDs básicos

## Responsável

**Integrante 2**

## Status

Pendente

## Dependências

- Sprint 0 concluída.
- Sprint 1 concluída.
- Models e tabelas disponíveis.
- Bootstrap 5 configurado.

## Objetivo

Criar a estrutura visual comum do sistema e implementar os CRUDs básicos de categorias, produtos, fornecedores e clientes.

## Escopo

- Layout Blade.
- Bootstrap 5.
- Navegação.
- Mensagens flash.
- CRUD de Categorias.
- CRUD de Produtos.
- CRUD de Fornecedores.
- CRUD de Clientes.
- Form Requests.
- Pesquisa.
- Paginação.
- Inativação/reativação.

## Tarefas

### Layout geral

- [ ] Criar layout Blade principal.
- [ ] Criar navegação lateral ou superior.
- [ ] Incluir Dashboard.
- [ ] Incluir menu Cadastros.
- [ ] Incluir menu Compras.
- [ ] Incluir menu Vendas.
- [ ] Incluir menu Estoque.
- [ ] Criar exibição padrão de mensagens flash.
- [ ] Garantir comportamento responsivo com Bootstrap 5.

### Categorias

- [ ] Criar Controller.
- [ ] Criar Form Requests.
- [ ] Criar rotas.
- [ ] Criar listagem.
- [ ] Criar cadastro.
- [ ] Criar visualização.
- [ ] Criar edição.
- [ ] Criar inativação.
- [ ] Criar reativação.
- [ ] Criar paginação.
- [ ] Criar pesquisa quando aplicável.

### Produtos

- [ ] Criar Controller.
- [ ] Criar Form Requests.
- [ ] Criar rotas.
- [ ] Criar listagem.
- [ ] Criar cadastro.
- [ ] Criar visualização.
- [ ] Criar edição.
- [ ] Criar inativação.
- [ ] Criar reativação.
- [ ] Criar paginação.
- [ ] Criar pesquisa.
- [ ] Selecionar categoria.
- [ ] Validar código de barras único.
- [ ] Validar quantidades mínima/máxima.
- [ ] Validar valores monetários.

### Fornecedores

- [ ] Criar Controller.
- [ ] Criar Form Requests.
- [ ] Criar rotas.
- [ ] Criar listagem.
- [ ] Criar cadastro.
- [ ] Criar visualização.
- [ ] Criar edição.
- [ ] Criar inativação.
- [ ] Criar reativação.
- [ ] Criar paginação.
- [ ] Criar pesquisa.
- [ ] Validar CNPJ único.

### Clientes

- [ ] Criar Controller.
- [ ] Criar Form Requests.
- [ ] Criar rotas.
- [ ] Criar listagem.
- [ ] Criar cadastro.
- [ ] Criar visualização.
- [ ] Criar edição.
- [ ] Criar inativação.
- [ ] Criar reativação.
- [ ] Criar paginação.
- [ ] Criar pesquisa.
- [ ] Validar CPF/CNPJ único.

## Critérios de aceite

- [ ] Todas as páginas utilizam o mesmo layout.
- [ ] Todas as operações usam Bootstrap 5.
- [ ] Controllers não possuem grandes blocos de validação.
- [ ] Validações ficam em Form Requests.
- [ ] Cadastros com histórico podem ser inativados.
- [ ] Listagens possuem paginação.
- [ ] Pesquisas funcionam onde fizer sentido.
- [ ] Mensagens de sucesso e erro são exibidas.
- [ ] Ações destrutivas pedem confirmação.
- [ ] Rotas seguem padrão consistente.
- [ ] A interface é utilizável em diferentes larguras de tela.

## Testes

Validar manualmente:

- [ ] cadastrar categoria;
- [ ] editar categoria;
- [ ] inativar e reativar categoria;
- [ ] cadastrar produto;
- [ ] tentar cadastrar código de barras duplicado;
- [ ] cadastrar fornecedor;
- [ ] tentar cadastrar CNPJ duplicado;
- [ ] cadastrar cliente;
- [ ] tentar cadastrar CPF/CNPJ duplicado;
- [ ] pesquisar registros;
- [ ] navegar entre páginas da paginação.

## Entregáveis

- Layout administrativo.
- Navegação.
- CRUD completo de Categorias.
- CRUD completo de Produtos.
- CRUD completo de Fornecedores.
- CRUD completo de Clientes.
- Form Requests desses módulos.

## Observações

Registrar aqui decisões ou problemas encontrados durante a sprint.

---

# Sprint 06 — Validações, testes e acabamento

## Responsável

**Integrante 2**

## Status

Pendente

## Dependências

- Sprints 1 a 5 concluídas.
- Todos os módulos principais integrados.

## Objetivo

Revisar a aplicação como um todo, corrigir inconsistências de validação e interface e executar testes funcionais antes da preparação final da entrega.

## Escopo

- Revisão de formulários.
- Revisão de Form Requests.
- Revisão das mensagens.
- Revisão de paginação e pesquisas.
- Revisão de responsividade.
- Testes funcionais dos módulos.
- Testes de entradas inválidas.
- Correções de acabamento sem adicionar novas funcionalidades fora do escopo.

## Tarefas

### Validações

- [ ] Revisar Form Requests de Categoria.
- [ ] Revisar Form Requests de Produto.
- [ ] Revisar Form Requests de Fornecedor.
- [ ] Revisar Form Requests de Cliente.
- [ ] Revisar Form Requests de Orçamento de Compra.
- [ ] Revisar Form Requests de Compra.
- [ ] Revisar Form Requests de Orçamento de Venda.
- [ ] Revisar Form Requests de Venda.
- [ ] Conferir campos `required`, `nullable`, `integer`, `numeric`, `min`, `unique`, `exists`, `email` e `date` conforme necessário.

### Interface

- [ ] Revisar mensagens flash.
- [ ] Revisar mensagens de validação.
- [ ] Revisar formulários em telas menores.
- [ ] Revisar tabelas e listagens.
- [ ] Revisar botões e ações.
- [ ] Revisar navegação.
- [ ] Revisar paginação.
- [ ] Revisar pesquisas.
- [ ] Verificar consistência visual entre módulos.

### Testes funcionais

- [ ] Testar CRUD de Categorias.
- [ ] Testar CRUD de Produtos.
- [ ] Testar CRUD de Fornecedores.
- [ ] Testar CRUD de Clientes.
- [ ] Testar Orçamento de Compra.
- [ ] Testar conversão Orçamento de Compra → Compra.
- [ ] Testar confirmação de Compra.
- [ ] Testar Orçamento de Venda.
- [ ] Testar conversão Orçamento de Venda → Venda.
- [ ] Testar confirmação de Venda.
- [ ] Testar Estoque Atual.
- [ ] Testar Estoque Baixo.
- [ ] Testar Movimentações.
- [ ] Testar Dashboard.

### Casos inválidos

- [ ] Testar quantidade zero.
- [ ] Testar quantidade negativa.
- [ ] Testar valor negativo.
- [ ] Testar produto repetido no mesmo documento.
- [ ] Testar código de barras duplicado.
- [ ] Testar CNPJ duplicado.
- [ ] Testar CPF/CNPJ duplicado.
- [ ] Testar venda com estoque insuficiente.
- [ ] Testar confirmação duplicada de compra.
- [ ] Testar confirmação duplicada de venda.
- [ ] Verificar que nenhum caso inválido produz alteração parcial de estoque.

## Critérios de aceite

- [ ] Nenhuma validação crítica depende somente de JavaScript.
- [ ] Erros de entrada são tratados de forma compreensível.
- [ ] Nenhuma compra/venda inválida altera parcialmente o estoque.
- [ ] Navegação e formulários permanecem consistentes.
- [ ] Não existem páginas quebradas no fluxo principal.
- [ ] Não foram adicionadas funcionalidades fora do escopo durante a revisão.

## Testes

Executar o fluxo completo:

```text
Cadastro
  ↓
Orçamento de Compra
  ↓
Compra
  ↓
Entrada no Estoque
  ↓
Orçamento de Venda
  ↓
Venda
  ↓
Saída do Estoque
  ↓
Movimentações
  ↓
Dashboard
```

- [ ] Fluxo completo executado sem erros.
- [ ] Dados conferidos diretamente no PostgreSQL quando necessário.
- [ ] Erros encontrados foram corrigidos e retestados.

## Entregáveis

- Aplicação revisada.
- Validações consistentes.
- Interface ajustada.
- Registro dos testes realizados.
- Correções encontradas durante a revisão.

## Observações

Registrar aqui os problemas encontrados, correções realizadas e testes relevantes.
