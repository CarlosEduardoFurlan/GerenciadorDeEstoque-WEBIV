# Data Model: Cadastro de Fornecedores (`003-fornecedores`)

**Branch**: `feature/003-fornecedores` | **Date**: 2026-11-18 | **Spec**: [spec.md](spec.md)

## Entidades

### 1. `Fornecedor` (`App\Models\Fornecedor`)

Representa a pessoa física ou jurídica responsável pelo fornecimento de produtos no processo de compras do sistema.

- **Tabela**: `fornecedor`
- **Chave Primária**: `id` (auto-incremento)
- **Timestamps**: `created_at`, `updated_at` (gerenciados pelo Eloquent via `$table->timestamps()`)

#### Atributos

| Campo | Tipo lógico / SQLite | Obrigatório | Restrições / Índices | Descrição |
|---|---|---|---|---|
| `id` | `integer` (`$table->id()`) | Sim | `PRIMARY KEY`, autoincremento | Identificador único do fornecedor |
| `nome` | `string(255)` | Sim | `NOT NULL`, `INDEX` | Nome ou razão social do fornecedor |
| `documento` | `string(30)` | Sim | `NOT NULL` | CPF ou CNPJ do fornecedor |
| `email` | `string(255)` | Sim | `NOT NULL` | Endereço de e-mail de contato |
| `endereco` | `string(255)` | Sim | `NOT NULL` | Endereço completo do fornecedor |
| `telefone` | `string(30)` | Sim | `NOT NULL` | Telefone de contato |
| `created_at` | `timestamp` | Não | `NULL` | Data de criação do registro |
| `updated_at` | `timestamp` | Não | `NULL` | Data da última atualização |

#### Configuração Eloquent Esperada

- `$table = 'fornecedor'`
- `$fillable = ['nome', 'documento', 'email', 'endereco', 'telefone']`

---

## Regras de Validação (`App\Http\Requests\FornecedorRequest`)

| Campo | Regras | Observação |
|---|---|---|
| `id` | `nullable`, `integer` | `0` indica novo cadastro; valor `> 0` indica atualização de registro existente |
| `nome` | `required`, `string`, `max:255` | Obrigatório |
| `documento` | `required`, `string`, `max:30` | Aceita CPF ou CNPJ com ou sem formatação |
| `email` | `required`, `string`, `email:rfc`, `max:255` | Formato válido de e-mail sem depender de consulta DNS externa |
| `endereco` | `required`, `string`, `max:255` | Obrigatório |
| `telefone` | `required`, `string`, `max:30` | Obrigatório |

### Mensagens de Erro em Português (`messages()`)

| Chave | Mensagem |
|---|---|
| `nome.required` | `Nome é obrigatório.` |
| `nome.max` | `Nome deve ter no máximo 255 caracteres.` |
| `documento.required` | `Documento é obrigatório.` |
| `documento.max` | `Documento deve ter no máximo 30 caracteres.` |
| `email.required` | `E-mail é obrigatório.` |
| `email.email` | `E-mail inválido.` |
| `email.max` | `E-mail deve ter no máximo 255 caracteres.` |
| `endereco.required` | `Endereço é obrigatório.` |
| `endereco.max` | `Endereço deve ter no máximo 255 caracteres.` |
| `telefone.required` | `Telefone é obrigatório.` |
| `telefone.max` | `Telefone deve ter no máximo 30 caracteres.` |

---

## Relacionamentos

- **Sprint 1 (escopo desta Spec)**: Entidade independente, sem chaves estrangeiras de entrada ou saída.
- **Sprint 2 (planejado para integração futura)**:
  - `Fornecedor` **1 : N** `Compra` (Spec 005 — `compra.fornecedor_id`)
  - `Fornecedor` **1 : N** `ContaPagar` (Spec 007 — `conta_pagar.fornecedor_id`)
