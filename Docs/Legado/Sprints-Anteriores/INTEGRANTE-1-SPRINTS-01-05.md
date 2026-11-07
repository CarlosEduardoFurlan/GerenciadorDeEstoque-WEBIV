# Integrante 1 — Sprints 01 e 05

Responsabilidade principal: **estrutura de dados, Models, estoque e dashboard**.

---

# Sprint 01 — Banco, Models e estrutura de domínio

## Responsável

**Integrante 1**

## Status

Pendente

## Dependências

- Sprint 0 concluída.
- Ambiente Laravel funcionando.
- PostgreSQL configurado.
- DER definitivo disponível em `Docs/DER.jpg`.
- Regras oficiais disponíveis em `Docs/CONTEXTO.md`.

## Objetivo

Transformar o DER definitivo em uma estrutura de banco PostgreSQL criada integralmente por migrations do Laravel e implementar os Models Eloquent com seus relacionamentos.

## Escopo

- Migrations das 13 entidades do projeto.
- Primary keys.
- Foreign keys.
- Unique constraints.
- Check constraints.
- Campos nullable quando definidos pelo DER.
- Models Eloquent.
- Relacionamentos Eloquent.
- Definição explícita dos nomes das tabelas em português.
- Factories.
- Seeders de categorias, produtos, fornecedores e clientes.

## Tarefas

### Migrations

- [ ] Criar migration de `categorias`.
- [ ] Criar migration de `produtos`.
- [ ] Criar migration de `fornecedores`.
- [ ] Criar migration de `clientes`.
- [ ] Criar migration de `orcamentos_compra`.
- [ ] Criar migration de `orcamento_compra_itens`.
- [ ] Criar migration de `compras`.
- [ ] Criar migration de `compra_itens`.
- [ ] Criar migration de `orcamentos_venda`.
- [ ] Criar migration de `orcamento_venda_itens`.
- [ ] Criar migration de `vendas`.
- [ ] Criar migration de `venda_itens`.
- [ ] Criar migration de `movimentacoes_estoque`.
- [ ] Conferir a ordem das migrations para respeitar todas as FKs.
- [ ] Implementar os tipos de dados exatamente conforme o DER.
- [ ] Implementar os `unique` simples.
- [ ] Implementar os `unique` compostos dos itens.
- [ ] Implementar os checks de quantidade e valores.
- [ ] Implementar os checks de status.
- [ ] Implementar os checks de movimentação de estoque.
- [ ] Garantir que compra/venda originadas de orçamento tenham FK nullable e única quando preenchida.

### Models

- [ ] Criar Model `Categoria`.
- [ ] Criar Model `Produto`.
- [ ] Criar Model `Fornecedor`.
- [ ] Criar Model `Cliente`.
- [ ] Criar Model `OrcamentoCompra`.
- [ ] Criar Model `OrcamentoCompraItem`.
- [ ] Criar Model `Compra`.
- [ ] Criar Model `CompraItem`.
- [ ] Criar Model `OrcamentoVenda`.
- [ ] Criar Model `OrcamentoVendaItem`.
- [ ] Criar Model `Venda`.
- [ ] Criar Model `VendaItem`.
- [ ] Criar Model `MovimentacaoEstoque`.
- [ ] Definir `protected $table` nos Models conforme os nomes explícitos das tabelas.
- [ ] Configurar `fillable` ou outra estratégia de mass assignment adotada pelo projeto.
- [ ] Configurar todos os relacionamentos `belongsTo`, `hasMany` e `hasOne` necessários.

### Seeders e factories

- [ ] Criar factory/seeder de categorias.
- [ ] Criar factory/seeder de produtos.
- [ ] Criar factory/seeder de fornecedores.
- [ ] Criar factory/seeder de clientes.
- [ ] Não criar compras ou vendas aleatórias nesta etapa.

## Critérios de aceite

- [ ] Todas as tabelas do DER são criadas somente por migrations.
- [ ] Todas as FKs funcionam corretamente.
- [ ] `codigo_barra` é único.
- [ ] `cnpj` é único.
- [ ] `cpf_cnpj` é único.
- [ ] Produtos repetidos no mesmo documento são impedidos pelas constraints.
- [ ] Quantidades inválidas são impedidas.
- [ ] Valores negativos são impedidos.
- [ ] Status fora dos valores permitidos são impedidos.
- [ ] Os 13 Models possuem os relacionamentos definidos.
- [ ] Os nomes de tabelas em português não dependem da pluralização automática em inglês.
- [ ] Os seeders criam somente dados apropriados para os cadastros básicos.

## Testes

Executar:

```bash
php artisan migrate:fresh --seed
```

Verificar:

- [ ] comando finaliza sem erros;
- [ ] todas as tabelas aparecem no PostgreSQL;
- [ ] os registros dos seeders são inseridos;
- [ ] as FKs estão presentes;
- [ ] os índices e constraints foram criados.

## Entregáveis

- Migrations.
- Models.
- Relacionamentos Eloquent.
- Factories.
- Seeders.
- Banco recriável do zero através de `migrate:fresh --seed`.

## Observações

Registrar aqui decisões ou problemas encontrados durante a sprint.

---

# Sprint 05 — Estoque, movimentações e dashboard

## Responsável

**Integrante 1**

## Status

Pendente

## Dependências

- Sprint 1 concluída.
- Sprint 2 concluída.
- Sprint 3 concluída.
- Sprint 4 concluída.
- Compras confirmadas gerando entradas.
- Vendas confirmadas gerando saídas.

## Objetivo

Criar as telas de consulta do estoque e das movimentações e construir o dashboard geral do sistema usando os dados gerados pelos módulos anteriores.

## Escopo

- Estoque atual.
- Produtos com estoque baixo.
- Histórico de movimentações.
- Filtros de movimentação.
- Dashboard.
- Últimas compras.
- Últimas vendas.
- Indicadores principais.

## Tarefas

### Estoque atual

- [ ] Criar rota de consulta do estoque atual.
- [ ] Criar Controller ou método responsável pela consulta.
- [ ] Criar view do estoque atual.
- [ ] Exibir produto.
- [ ] Exibir categoria.
- [ ] Exibir quantidade atual.
- [ ] Exibir quantidade mínima.
- [ ] Exibir quantidade máxima.
- [ ] Exibir situação do estoque.

### Estoque baixo

- [ ] Criar consulta para `qtde_estoque <= qtde_minima`.
- [ ] Criar tela de produtos com estoque baixo.
- [ ] Destacar claramente produtos abaixo ou iguais ao mínimo.

### Movimentações

- [ ] Criar tela de histórico de movimentações.
- [ ] Exibir produto.
- [ ] Exibir tipo `ENTRADA` ou `SAIDA`.
- [ ] Exibir quantidade.
- [ ] Exibir saldo anterior.
- [ ] Exibir saldo posterior.
- [ ] Exibir data/hora.
- [ ] Exibir origem quando houver compra.
- [ ] Exibir origem quando houver venda.
- [ ] Criar filtro por produto.
- [ ] Criar filtro por tipo.
- [ ] Criar filtro por período, se mantido simples e compatível com o escopo.
- [ ] Adicionar paginação.

### Dashboard

- [ ] Criar tela inicial do dashboard.
- [ ] Exibir quantidade de produtos ativos.
- [ ] Exibir quantidade de clientes ativos.
- [ ] Exibir quantidade de fornecedores ativos.
- [ ] Exibir quantidade de produtos com estoque baixo.
- [ ] Exibir últimas compras.
- [ ] Exibir últimas vendas.
- [ ] Exibir lista resumida de produtos abaixo do mínimo.

## Critérios de aceite

- [ ] Estoque exibido corresponde a `produtos.qtde_estoque`.
- [ ] Produtos com estoque baixo são identificados pela regra oficial.
- [ ] Movimentações exibem saldo anterior e posterior corretamente.
- [ ] Entradas e saídas são visualmente distinguíveis.
- [ ] Dashboard usa dados reais do sistema.
- [ ] Consultas não alteram o estoque.
- [ ] Páginas utilizam o layout definido na Sprint 2.

## Testes

- [ ] Confirmar uma compra e verificar a nova quantidade no estoque.
- [ ] Confirmar uma venda e verificar a nova quantidade no estoque.
- [ ] Conferir a entrada no histórico.
- [ ] Conferir a saída no histórico.
- [ ] Validar o saldo anterior e posterior.
- [ ] Criar situação de estoque baixo e conferir sua exibição.
- [ ] Conferir os totais apresentados no dashboard.

## Entregáveis

- Tela de estoque atual.
- Tela de estoque baixo.
- Histórico de movimentações.
- Filtros básicos.
- Dashboard completo conforme o escopo oficial.

## Observações

Registrar aqui decisões ou problemas encontrados durante a sprint.
