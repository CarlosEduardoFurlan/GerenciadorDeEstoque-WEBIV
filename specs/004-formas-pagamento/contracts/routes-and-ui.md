# Contract: Rotas e Interface de Formas de Pagamento

Todas as rotas exigem autenticação pelo middleware já disponível no projeto.

| Método | Caminho | Nome | Resultado |
|---|---|---|---|
| GET | `/formas-pagamento` | `formas-pagamento.index` | lista paginada em 10 registros |
| GET | `/formas-pagamento/novo` | `formas-pagamento.create` | formulário vazio |
| POST | `/formas-pagamento` | `formas-pagamento.store` | valida e cadastra forma e itens |
| GET | `/formas-pagamento/{formaPagamento}` | `formas-pagamento.show` | detalhes da forma e itens |
| GET | `/formas-pagamento/{formaPagamento}/editar` | `formas-pagamento.edit` | formulário preenchido |
| PUT | `/formas-pagamento/{formaPagamento}` | `formas-pagamento.update` | valida e altera forma e itens |
| DELETE | `/formas-pagamento/{formaPagamento}` | `formas-pagamento.destroy` | exclui forma e itens após confirmação |

## Contrato do formulário

```text
descricao
numero_parcelas
itens[0][porcentagem]
itens[0][dia]
itens[1][porcentagem]
itens[1][dia]
...
```

- Erros são exibidos próximos aos campos e em resumo quando se referirem à coleção.
- Os valores enviados são preservados após falha de validação.
- A interface permite adicionar e remover linhas de item para corresponder ao número de parcelas.
- JavaScript pode auxiliar na manipulação das linhas, mas o backend é a autoridade das regras.
- Cadastro, alteração e exclusão bem-sucedidos redirecionam para a listagem com mensagem de sucesso.
- A exclusão usa formulário protegido e confirmação explícita no navegador.

