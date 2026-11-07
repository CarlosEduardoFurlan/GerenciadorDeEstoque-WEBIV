# CONTEXTO DO PROJETO: Sistema de Controle de Estoque

> Cole este arquivo no início de uma nova conversa para retomar o projeto de onde paramos.
> Versão 2: atualizada com o DER definitivo (diagrama com tipos de dados).

## 1. Visão geral

- **Disciplina:** Construção de Páginas Web IV
- **Curso:** Tecnologia em Sistemas para Internet (IFMS)
- **Tipo:** trabalho acadêmico
- **Tema:** Sistema de Controle de Estoque
- **Requisitos do professor:** cadastro de produtos, fornecedores, orçamento de compra, compra, orçamento de venda, venda e clientes. As categorias entram porque fazem parte do DER.
- **Modelo oficial:** o DER da seção 4 (diagrama definitivo com tipos de dados + regras e constraints descritas em texto). Qualquer mudança só com pedido explícito do usuário.

## 2. Tecnologias

| Camada | Tecnologia |
|---|---|
| Backend | PHP + Laravel |
| Banco | PostgreSQL |
| Frontend | Laravel Blade + Bootstrap 5 (JavaScript só quando necessário) |
| Arquitetura | MVC do Laravel, Eloquent ORM, migrations, Form Requests, Services para regras de negócio, named routes, route model binding |

**Prioridades:** clareza, organização, boas práticas, facilidade para explicar o código, funcionamento correto, evitar complexidade desnecessária. Sem arquiteturas excessivamente complexas.

## 3. Forma de trabalho (IMPORTANTE)

Desenvolvimento **incremental, etapa por etapa**. Nunca gerar o sistema todo de uma vez.

Em cada etapa:

1. Explicar primeiro o que vamos fazer.
2. Informar os comandos Artisan/Composer.
3. Informar o caminho completo de cada arquivo.
4. Apresentar o código completo quando o arquivo for criado.
5. Se alterar arquivo existente, explicar exatamente a alteração.
6. Explicar as partes importantes do código.
7. Informar como testar.
8. **Aguardar a confirmação do usuário** de que funcionou.
9. Só então avançar.

Regras extras:

- Não pular etapas e não supor que algo funcionou sem confirmação.
- Em caso de erro, primeiro diagnosticar o erro atual, sem alterar várias partes do projeto sem necessidade.
- Se parecer necessária nova funcionalidade ou tabela, explicar o motivo **antes** de mexer no modelo.

## 4. DER oficial

### 4.1 Tipos de dados por tabela (conforme o diagrama)

Todas as tabelas têm `id BIGINT` como PK. Colunas `*_id` são `BIGINT` (FK).

**CATEGORIA**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| nome | VARCHAR(100) |
| margem_lucro | NUMERIC(5,2) |
| ativo | BOOLEAN |

**PRODUTO**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| categoria_id | BIGINT (FK → categorias) |
| nome | VARCHAR(150) |
| embalagem | VARCHAR(30) |
| qtde_estoque | INTEGER |
| qtde_minima | INTEGER |
| qtde_maxima | INTEGER |
| codigo_barra | VARCHAR(50) |
| valor_compra | NUMERIC(12,2) |
| valor_venda | NUMERIC(12,2) |
| ativo | BOOLEAN |

**FORNECEDOR**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| razao_social | VARCHAR(150) |
| nome_fantasia | VARCHAR(150) |
| endereco | VARCHAR(255) |
| fone | VARCHAR(20) |
| email | VARCHAR(100) |
| cnpj | VARCHAR(20) |
| ativo | BOOLEAN |

**CLIENTE**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| nome | VARCHAR(150) |
| cpf_cnpj | VARCHAR(20) |
| endereco | VARCHAR(255) |
| fone | VARCHAR(20) |
| email | VARCHAR(100) |
| ativo | BOOLEAN |

**ORCAMENTO_COMPRA**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| fornecedor_id | BIGINT (FK → fornecedores) |
| data | DATE |
| documento | VARCHAR(100) |
| total | NUMERIC(12,2) |
| status | VARCHAR(20) |

**ORCAMENTO_COMPRA_ITEM**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| orcamento_compra_id | BIGINT (FK → orcamentos_compra) |
| produto_id | BIGINT (FK → produtos) |
| quantidade | INTEGER |
| valor_unitario | NUMERIC(12,2) |
| subtotal | NUMERIC(12,2) |

**COMPRA**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| fornecedor_id | BIGINT (FK → fornecedores) |
| orcamento_compra_id | BIGINT (FK nullable → orcamentos_compra) |
| data | DATE |
| documento | VARCHAR(100) |
| total | NUMERIC(12,2) |
| status | VARCHAR(20) |

**COMPRA_ITEM**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| compra_id | BIGINT (FK → compras) |
| produto_id | BIGINT (FK → produtos) |
| quantidade | INTEGER |
| valor_unitario | NUMERIC(12,2) |
| subtotal | NUMERIC(12,2) |

**ORCAMENTO_VENDA**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| cliente_id | BIGINT (FK → clientes) |
| data | DATE |
| validade | DATE |
| total | NUMERIC(12,2) |
| status | VARCHAR(20) |

**ORCAMENTO_VENDA_ITEM**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| orcamento_venda_id | BIGINT (FK → orcamentos_venda) |
| produto_id | BIGINT (FK → produtos) |
| quantidade | INTEGER |
| valor_unitario | NUMERIC(12,2) |
| subtotal | NUMERIC(12,2) |

**VENDA** (não possui campo `documento`)

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| cliente_id | BIGINT (FK → clientes) |
| orcamento_venda_id | BIGINT (FK nullable → orcamentos_venda) |
| data | DATE |
| total | NUMERIC(12,2) |
| status | VARCHAR(20) |

**VENDA_ITEM**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| venda_id | BIGINT (FK → vendas) |
| produto_id | BIGINT (FK → produtos) |
| quantidade | INTEGER |
| valor_unitario | NUMERIC(12,2) |
| subtotal | NUMERIC(12,2) |

**MOVIMENTACAO_ESTOQUE**

| Coluna | Tipo |
|---|---|
| id | BIGINT (PK) |
| produto_id | BIGINT (FK → produtos) |
| compra_item_id | BIGINT (FK nullable → compra_itens) |
| venda_item_id | BIGINT (FK nullable → venda_itens) |
| tipo | VARCHAR(10) |
| quantidade | INTEGER |
| saldo_anterior | INTEGER |
| saldo_posterior | INTEGER |
| data | TIMESTAMP |

> Observação: todas as quantidades e saldos são **INTEGER** (não há quantidade fracionada). Valores em dinheiro são sempre **NUMERIC(12,2)**; `margem_lucro` é NUMERIC(5,2). Datas de documentos são `DATE`; a data da movimentação é `TIMESTAMP`.

### 4.2 Relacionamentos (cardinalidades do diagrama)

| Relacionamento | Cardinalidade |
|---|---|
| Categoria **possui** Produto | 1 : N |
| Fornecedor **fornece** Orçamento de Compra | 1 : N |
| Fornecedor **fornece** Compra | 1 : N |
| Orçamento de Compra **possui** Itens | 1 : N |
| Orçamento de Compra **origina** Compra | 0..1 : 1 (um orçamento gera no máximo uma compra) |
| Compra **possui** Itens | 1 : N |
| Cliente **recebe** Orçamento de Venda | 1 : N |
| Orçamento de Venda **possui** Itens | 1 : N |
| Orçamento de Venda **origina** Venda | 0..1 : 1 (um orçamento gera no máximo uma venda) |
| Venda **possui** Itens | 1 : N |
| Produto **participa** dos itens de orçamento/compra/venda | 1 : N (via `produto_id` em cada tabela de item) |
| Produto **possui** Movimentações | 1 : N |
| Compra_Item **gera** Movimentação | 1 : 0..1 |
| Venda_Item **gera** Movimentação | 1 : 0..1 |

### 4.3 Regras e constraints (complementam o diagrama)

**Produto**
- `codigo_barra` único
- `qtde_estoque >= 0`
- `qtde_minima >= 0`
- `qtde_maxima >= qtde_minima`
- `valor_compra >= 0`
- `valor_venda >= 0`

**Fornecedor:** `cnpj` único.
**Cliente:** `cpf_cnpj` único.

**Status permitidos** (VARCHAR(20), controlados por check constraint):
- Orçamento de compra e orçamento de venda: `PENDENTE`, `APROVADO`, `CONVERTIDO`, `CANCELADO`
- Compra e venda: `PENDENTE`, `CONFIRMADA`, `CANCELADA`

**Itens (os 4 tipos de item)**
- `subtotal = quantidade * valor_unitario`
- `quantidade > 0`
- `valor_unitario >= 0`
- Unique composto, sem produto repetido no mesmo documento:
  - `orcamento_compra_itens`: `orcamento_compra_id + produto_id`
  - `compra_itens`: `compra_id + produto_id`
  - `orcamento_venda_itens`: `orcamento_venda_id + produto_id`
  - `venda_itens`: `venda_id + produto_id`

**Compra / Venda originadas de orçamento:** `orcamento_compra_id` e `orcamento_venda_id` são nullable e **únicos quando preenchidos** (garante no máximo uma compra/venda por orçamento).

**Movimentação de estoque**
- `tipo` (VARCHAR(10)): `ENTRADA` ou `SAIDA` (check constraint)
- Relacionada a `compra_item_id` **ou** `venda_item_id`, nunca aos dois (check constraint)
- Coerência sugerida: `ENTRADA` ↔ `compra_item_id`; `SAIDA` ↔ `venda_item_id`
- `compra_item_id` único quando preenchido; `venda_item_id` único quando preenchido. Isso impede lançar a mesma compra/venda duas vezes no estoque.

## 5. Regras de negócio

### Regra central do estoque
- **Orçamento nunca altera estoque.**
- **Compra/venda PENDENTE não altera estoque.**
- O estoque só muda ao **confirmar** (PENDENTE → CONFIRMADA).

### Confirmar compra
1. Iniciar transação (`DB::transaction()`).
2. Buscar produtos envolvidos com `lockForUpdate()`.
3. Guardar `saldo_anterior`.
4. Somar a quantidade comprada.
5. Atualizar `produtos.qtde_estoque`.
6. Registrar `MOVIMENTACAO_ESTOQUE` tipo `ENTRADA`.
7. Guardar `saldo_posterior`.
8. Marcar compra como `CONFIRMADA`.
9. Commit. Qualquer erro: rollback.
- Compra confirmada não pode ser confirmada de novo.
- Se ultrapassar `qtde_maxima`: **apenas aviso**, não bloquear.

### Confirmar venda
1. Iniciar transação.
2. Carregar produtos (com `lockForUpdate()`).
3. Verificar estoque disponível; **impedir estoque negativo**.
4. Guardar `saldo_anterior`.
5. Diminuir a quantidade vendida.
6. Atualizar `produtos.qtde_estoque`.
7. Criar movimentação `SAIDA`.
8. Guardar `saldo_posterior`.
9. Marcar venda como `CONFIRMADA`.
10. Commit.
- Se qualquer produto não tiver estoque: rollback total. Nenhum item é processado parcialmente.
- Venda confirmada não pode ser confirmada de novo.

### Estoque baixo
Se `qtde_estoque <= qtde_minima`, o produto aparece como **ESTOQUE BAIXO**.

### Orçamento de compra → compra (ação "GERAR COMPRA")
Só para orçamento `APROVADO`. Cria a compra, copia fornecedor, documento (quando aplicável), itens, quantidades, valores e subtotais, calcula o total, relaciona a compra ao orçamento e marca o orçamento como `CONVERTIDO`. **Não altera estoque.**

### Orçamento de venda → venda (ação "GERAR VENDA")
Só para orçamento `APROVADO`. Cria a venda, copia cliente, itens, preços e quantidades, calcula o total, relaciona a venda ao orçamento e marca o orçamento como `CONVERTIDO`. **Não altera estoque.**

### Valores monetários
- Nunca usar FLOAT. Usar `NUMERIC(12,2)` / `decimal(12, 2)` no PostgreSQL.
- `subtotal = quantidade * valor_unitario`; `total = soma dos subtotais`.
- Totais sempre calculados no **backend**; nunca confiar só no JavaScript.

### Exclusão e inativação
- Categoria, produto, cliente e fornecedor têm `ativo`. Com histórico relacionado, preferir **inativar** em vez de excluir.
- Compras e vendas `CONFIRMADAS` não podem ser excluídas.
- **Estorno não será implementado** na primeira versão (só se o usuário pedir depois).

## 6. Interface

Blade + Bootstrap 5, layout administrativo responsivo, menu lateral ou superior:

- Dashboard
- Cadastros: Categorias, Produtos, Fornecedores, Clientes
- Compras: Orçamentos de compra, Compras
- Vendas: Orçamentos de venda, Vendas
- Estoque: Estoque atual, Estoque baixo, Movimentações

**CRUD** (categorias, produtos, fornecedores, clientes): listar, cadastrar, visualizar, editar, inativar/reativar.

**Listagens:** paginação, pesquisa quando fizer sentido, botões de ação, mensagens flash de sucesso/erro, confirmação antes de operações destrutivas.

**Dashboard:** produtos ativos, clientes ativos, fornecedores ativos, nº de produtos com estoque baixo, últimas compras, últimas vendas, lista de produtos abaixo do mínimo.

## 7. Padrões de código

- **Validação:** sempre em Form Requests (nada de blocos grandes nos Controllers). Usar `required`, `nullable`, `numeric`, `integer`, `min`, `max`, `unique`, `exists`, `email`, `date` conforme necessário.
- **Services:** `CompraService`, `VendaService`, `OrcamentoCompraService`, `OrcamentoVendaService`. Controllers ficam simples.
  - `CompraService`: confirmar compra, atualizar estoque, registrar entradas, impedir confirmação duplicada, transação.
  - `VendaService`: conferir estoque, confirmar venda, atualizar estoque, registrar saídas, impedir estoque negativo, impedir confirmação duplicada, transação.
  - `OrcamentoCompraService` / `OrcamentoVendaService`: calcular total, aprovar, converter em compra/venda.
- **Models:** `Categoria`, `Produto`, `Fornecedor`, `Cliente`, `OrcamentoCompra`, `OrcamentoCompraItem`, `Compra`, `CompraItem`, `OrcamentoVenda`, `OrcamentoVendaItem`, `Venda`, `VendaItem`, `MovimentacaoEstoque`, com todos os relacionamentos Eloquent.
- **Banco:** tudo por migrations (nada de criar tabelas no pgAdmin). Usar PKs, FKs, unique constraints, índices e check constraints. Cascade/restrict de forma consciente; **sem cascade delete indiscriminado em tabelas históricas**.
- **Nomes:** domínio em português (Produto, Cliente, Fornecedor, Compra, Venda...). Tabelas em plural snake_case. Não misturar português e inglês aleatoriamente. Seguir convenções do Laravel.
- **Seeders/Factories:** categorias, produtos, fornecedores e clientes (Faker permitido). **Não** gerar compras/vendas aleatórias, para não atrapalhar os testes das regras de estoque.
- **Segurança de dados:** `DB::transaction()` e `lockForUpdate()` nas confirmações. Regras críticas sempre no backend.

### Pontos a decidir na Etapa 2 (nomes de tabelas e plural)

O Laravel pluraliza em inglês por padrão (ex.: `compra_item` viraria `compra_items`). Como os nomes de domínio são em português, a Etapa 2 deve definir os nomes das tabelas de forma explícita (por exemplo `categorias`, `produtos`, `fornecedores`, `clientes`, `orcamentos_compra`, `orcamento_compra_itens`, `compras`, `compra_itens`, `orcamentos_venda`, `orcamento_venda_itens`, `vendas`, `venda_itens`, `movimentacoes_estoque`) e declarar `protected $table` em cada Model. As tabelas nas colunas "FK → ..." da seção 4.1 já seguem essa sugestão.

## 8. Fora do escopo (não adicionar sem autorização)

Nota fiscal, integração bancária, pagamento online, marketplace, múltiplos depósitos, múltiplas filiais, controle financeiro completo, contas a pagar/receber, logística, transportadora, APIs externas.

## 9. Roteiro de etapas

| # | Etapa | Status |
|---|---|---|
| 1 | Criar projeto Laravel e configurar PostgreSQL | **Instruções entregues, aguardando confirmação** |
| 2 | Migrations | Pendente |
| 3 | Models e relacionamentos Eloquent | Pendente |
| 4 | Seeders e factories | Pendente |
| 5 | Layout Blade/Bootstrap | Pendente |
| 6 | CRUD de Categorias | Pendente |
| 7 | CRUD de Produtos | Pendente |
| 8 | CRUD de Fornecedores | Pendente |
| 9 | CRUD de Clientes | Pendente |
| 10 | Orçamento de Compra | Pendente |
| 11 | Conversão do orçamento em Compra | Pendente |
| 12 | Confirmação da Compra e entrada no estoque | Pendente |
| 13 | Orçamento de Venda | Pendente |
| 14 | Conversão do orçamento em Venda | Pendente |
| 15 | Confirmação da Venda e saída do estoque | Pendente |
| 16 | Histórico de Movimentações | Pendente |
| 17 | Dashboard | Pendente |
| 18 | Validações e melhorias de interface | Pendente |
| 19 | Testes do fluxo completo | Pendente |
| 20 | Revisão e preparação para apresentação | Pendente |

## 10. Estado atual (Etapa 1)

Decisões e configurações propostas:

- Pasta do projeto: `controle-estoque` (criado com `composer create-project laravel/laravel controle-estoque`)
- Banco: `controle_estoque` (criado vazio, `ENCODING = 'UTF8'`); tabelas só por migration
- `.env`: `DB_CONNECTION=pgsql`, `DB_HOST=127.0.0.1`, `DB_PORT=5432`, `DB_DATABASE=controle_estoque`, `DB_USERNAME`/`DB_PASSWORD` do usuário
- `.env`: `APP_NAME="Controle de Estoque"`, `APP_LOCALE=pt_BR`, `APP_FALLBACK_LOCALE=pt_BR`, `APP_FAKER_LOCALE=pt_BR`
- `config/app.php`: `'timezone' => 'America/Campo_Grande'`
- Tradução das validações: pacote `lucascudo/laravel-pt-br-localization` (opcional; se der incompatibilidade, criar o arquivo de tradução manualmente depois)
- Teste: `php artisan config:clear`, `php artisan migrate`, `php artisan serve`

**Pendente do usuário (checklist da Etapa 1):**

1. `php artisan migrate` rodou sem erro?
2. As tabelas padrão apareceram no pgAdmin?
3. A página inicial do Laravel abriu em `http://127.0.0.1:8000`?

Se algo falhar, enviar a mensagem de erro completa e a saída de `php -v` e `php artisan --version`.

**Próximo passo após confirmação:** ETAPA 2, criação das migrations (todas as tabelas, tipos, FKs, unique e check constraints do DER).

## 11. Registro de ambiente (preencher)

- Versão do PHP: ____
- Versão do Laravel: ____
- Versão do PostgreSQL: ____
- Sistema operacional: ____
- Observações / problemas encontrados: ____
