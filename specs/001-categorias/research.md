# Decisões: Categorias

- **Margem**: preço de venda = valor de compra + percentual da margem da categoria sobre o valor de compra. Ex.: R$ 100 e 30% → R$ 130. Confirmado em 2026-11-26.
- **Persistência**: tabela `categoria` em português e singular, `descricao` obrigatória, `margem_lucro` decimal (7,2) não negativa. O produto da Spec 002 deverá referenciar `categoria_id` e guardar `valor_compra` e `valor_venda` decimais.
- **Integridade**: atualização de margem e todos os preços em transação. Converter valores decimais a inteiros de centavos e margem a centésimos de percentual para evitar float em dinheiro; arredondar meio centavo para cima.
- **Dependência**: enquanto a tabela `produto` não existe, a categoria pode ser criada e alterada sem produtos. Assim que a Spec 002 a adicionar, o recálculo e a proteção contra exclusão tornam-se ativos pelo mesmo serviço. A integração deve ser conferida no PR da 002.
- **Exclusão**: rejeitar categoria com produtos vinculados; não remover produtos em cascata.
