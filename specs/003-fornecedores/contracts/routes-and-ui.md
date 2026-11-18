# Interface Contracts: Rotas Web e Views Blade (`003-fornecedores`)

**Branch**: `feature/003-fornecedores` | **Date**: 2026-11-18 | **Spec**: [spec.md](../spec.md)

## 1. Contrato de Rotas Web (`routes/web.php`)

Todas as rotas da feature devem estar protegidas pelo middleware `auth` (`Route::middleware('auth')->group(...)`), redirecionando usuários não autenticados para a rota nomeada `login`.

| Método | URI | Controller / Action | Entrada | Resposta / Redirecionamento |
|---|---|---|---|---|
| `GET` | `/fornecedor/listar` | `FornecedorController@listar` | Query `?page=N` (opcional) | View `listagem_fornecedor` com `$fornecedores` (`LengthAwarePaginator`, 10 por página, ordenado por `nome`) |
| `GET` | `/fornecedor/novo` | `FornecedorController@novo` | — | View `formulario_fornecedor` com `$fornecedor` (instância nova com `id = 0` e campos vazios) |
| `POST` | `/fornecedor/salvar` | `FornecedorController@salvar` | `FornecedorRequest` (`id`, `nome`, `documento`, `email`, `endereco`, `telefone`) | Se válido: cria (quando `id == 0`) ou atualiza (`Fornecedor::findOrFail($id)`) e redireciona para `/fornecedor/listar`. Se inválido: retorna ao formulário com erros e `old()` |
| `GET` | `/fornecedor/editar/{id}` | `FornecedorController@editar` | Parâmetro de rota `{id}` | View `formulario_fornecedor` com `$fornecedor` (`Fornecedor::findOrFail($id)`); `404` se inexistente |
| `GET` | `/fornecedor/excluir/{id}` | `FornecedorController@excluir` | Parâmetro de rota `{id}` | Exclui `Fornecedor::findOrFail($id)` e redireciona para `/fornecedor/listar`; `404` se inexistente |

---

## 2. Contrato das Views Blade (`resources/views/`)

### 2.1. `resources/views/template.blade.php`

- Layout base utilizando Bootstrap 5 (via Vite ou assets configurados no projeto) e estrutura equivalente ao Capítulo 9 do material da disciplina.
- Barra de navegação superior contendo link para `/fornecedor/listar`.
- Seção principal (`<main class="container">`) expondo `@yield('conteudo')`.

### 2.2. `resources/views/listagem_fornecedor.blade.php`

- Herda de `template` (`@extends('template')`) e define `@section('conteudo')`.
- Cabeçalho com título ("Listagem de Fornecedores") e botão/link "Novo Fornecedor" apontando para `{{ url('fornecedor/novo') }}`.
- Tabela estilizada com Bootstrap 5 (`table table-bordered table-striped table-hover`) exibindo as colunas:
  - `ID` (`$fornecedor->id`)
  - `Nome` (`$fornecedor->nome`)
  - `Documento` (`$fornecedor->documento`)
  - `E-mail` (`$fornecedor->email`)
  - `Endereço` (`$fornecedor->endereco`)
  - `Telefone` (`$fornecedor->telefone`)
  - `Editar` (link para `{{ url("fornecedor/editar/$fornecedor->id") }}`)
  - `Excluir` (link para `{{ url("fornecedor/excluir/$fornecedor->id") }}`)
- Tratamento de listagem vazia (mensagem informativa ou corpo da tabela sem erros quando `$fornecedores` estiver vazio).
- Controles de paginação após a tabela: `{{ $fornecedores->links() }}` (renderizados com `Paginator::useBootstrapFive()`).

### 2.3. `resources/views/formulario_fornecedor.blade.php`

- Herda de `template` (`@extends('template')`) e define `@section('conteudo')`.
- Bloco de exibição de erros de validação (`@if ($errors->any())`) listando `$errors->all()` dentro de `div.alert.alert-danger`.
- Formulário com `action="{{ url('fornecedor/salvar') }}"` e `method="POST"` contendo `@csrf`.
- Campos do formulário com valores preservados via `old()`:
  - `id`: `type="text"`, `readonly`, `name="id"`, `value="{{ old('id', $fornecedor->id) }}"`
  - `nome`: `type="text"`, `name="nome"`, `value="{{ old('nome', $fornecedor->nome) }}"`
  - `documento`: `type="text"`, `name="documento"`, `value="{{ old('documento', $fornecedor->documento) }}"`
  - `email`: `type="email"`, `name="email"`, `value="{{ old('email', $fornecedor->email) }}"`
  - `endereco`: `type="text"`, `name="endereco"`, `value="{{ old('endereco', $fornecedor->endereco) }}"`
  - `telefone`: `type="text"`, `name="telefone"`, `value="{{ old('telefone', $fornecedor->telefone) }}"`
- Botão `submit` ("Salvar") e link secundário para voltar a `{{ url('fornecedor/listar') }}`.
