# Research: Cadastro de Fornecedores (`003-fornecedores`)

**Branch**: `feature/003-fornecedores` | **Date**: 2026-11-18 | **Spec**: [spec.md](spec.md)

## Decisões Técnicas

### 1. Padrão de Rotas e Controller (`FornecedorController`)

- **Decision**: Adotar as 5 actions convencionais ensinadas pelo professor (`listar`, `novo`, `salvar`, `editar`, `excluir`) mapeadas em `routes/web.php` (`/fornecedor/listar`, `/fornecedor/novo`, `/fornecedor/salvar`, `/fornecedor/editar/{id}`, `/fornecedor/excluir/{id}`). No método `novo()`, instanciar `Fornecedor` com `id = 0` e campos vazios para reutilizar `formulario_fornecedor.blade.php` tanto na criação quanto na edição.
- **Rationale**: Segue fielmente os Capítulos 5, 6 e 8 do material da disciplina e o Princípio VI (Simplicidade) da Constitution, facilitando a manutenção e a explicação do código em avaliação acadêmica.
- **Alternatives considered**: `Route::resource('fornecedores', ...)` com métodos RESTful (`index`, `create`, `store`, `edit`, `update`, `destroy`) — descartado para manter total aderência ao padrão didático do professor e às demais specs do grupo.

### 2. Nomenclatura de Tabela e Model Eloquent (`Fornecedor`)

- **Decision**: Nomear a tabela como `fornecedor` (singular, `snake_case`, em português), configurando `protected $table = 'fornecedor';` e `protected $fillable = ['nome', 'documento', 'email', 'endereco', 'telefone'];` no model `App\Models\Fornecedor`, mantendo `timestamps()` na migration conforme o Capítulo 12 do material da disciplina.
- **Rationale**: Atende ao Princípio VIII da Constitution (domínio e tabelas em português e `snake_case`) e ao padrão de migrations com SQLite ensinado no Capítulo 12.
- **Alternatives considered**: Tabela no plural `fornecedores` — descartada porque o tutorial do professor padroniza tabelas no singular (`categoria`, `cliente`, `servico`, `atendimento`) com `protected $table` explícito no Model.

### 3. Validação de Formulário (`FornecedorRequest`)

- **Decision**: Criar `App\Http\Requests\FornecedorRequest` com `authorize(): bool { return true; }`, `rules()` exigindo `nome`, `documento`, `email`, `endereco` e `telefone` (`required`, `string`, limites de tamanho adequados e `email:rfc` para `email`) e `messages()` com mensagens claras em português. Exibir erros com `@if ($errors->any())` e preservar entradas com `old('campo', $fornecedor->campo)` no Blade.
- **Rationale**: Segue o Capítulo 8 do tutorial (separando validação do controlador) e o Princípio VII da Constitution. O uso de `email:rfc` (sem `dns`) evita falhas por ausência de resolução DNS externa durante testes automatizados (`php artisan test`) ou execução offline.
- **Alternatives considered**: Validação inline `$request->validate(...)` no controller ou regra `email:rfc,dns` — descartados para não sobrecarregar o controller (Cap. 8) e para garantir execução determinística dos testes offline.

### 4. Paginação de 10 Registros e Layout Bootstrap 5

- **Decision**: Utilizar `Fornecedor::orderBy('nome')->paginate(10)` em `listar()`, renderizar `{{ $fornecedores->links() }}` em `listagem_fornecedor.blade.php` e configurar `Paginator::useBootstrapFive()` em `App\Providers\AppServiceProvider::boot()`. Estruturar as views `listagem_fornecedor.blade.php` e `formulario_fornecedor.blade.php` herdando de `resources/views/template.blade.php` (`@extends('template')` / `@section('conteudo')`).
- **Rationale**: Atende à regra obrigatória de paginação de 10 em 10 registros da Constitution (Princípio VII) e aos Capítulos 9 e 13 do material do professor.
- **Alternatives considered**: Paginação de 6 itens usada como exemplo ilustrativo no tutorial — descartada porque a Constitution e os requisitos vigentes do professor determinam explicitamente 10 registros por página.

### 5. Proteção por Autenticação (Integração com Spec 009)

- **Decision**: Agrupar todas as rotas `/fornecedor/*` sob `Route::middleware('auth')->group(...)` em `routes/web.php`, conforme Capítulo 14. Caso a rota nomeada `login` (da Spec 009 — Autenticação com Laravel Breeze) ainda não tenha sido integrada na branch `development`, garantir uma rota `login` mínima de fallback se ausente para que o redirecionamento do middleware `auth` funcione isoladamente nos testes.
- **Rationale**: Cumpre `FR-007` e o Princípio III da Constitution sem bloquear o desenvolvimento e os testes independentes da Spec 003 na Sprint 1.
- **Alternatives considered**: Deixar rotas públicas até o merge da Spec 009 — descartado porque violaria `FR-007` e `SC-004`.
