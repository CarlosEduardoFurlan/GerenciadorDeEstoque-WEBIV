# Rotas e interface: Categorias

| Método | URI | Nome | Resultado |
|---|---|---|---|
| GET | `/categorias` | `categorias.index` | listagem paginada de dez |
| GET | `/categorias/nova` | `categorias.create` | formulário de cadastro |
| POST | `/categorias` | `categorias.store` | validação e criação |
| GET | `/categorias/{categoria}/editar` | `categorias.edit` | formulário de edição |
| PUT | `/categorias/{categoria}` | `categorias.update` | atualização atômica da margem e preços |
| DELETE | `/categorias/{categoria}` | `categorias.destroy` | exclusão apenas sem produtos |

Todas as rotas usam `auth`; formulários enviam CSRF. Campos `descricao` e `margem_lucro` apresentam erros e preservam os valores enviados. A listagem usa Bootstrap e exibe mensagem vazia.
