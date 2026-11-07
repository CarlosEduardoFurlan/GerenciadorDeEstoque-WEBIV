# Integrante 3 — Sprints 03 e 07

Responsabilidade principal: **fluxo de compras, documentação e preparação da apresentação**.

---

# Sprint 03 — Fluxo completo de compras

## Responsável

**Integrante 3**

## Status

Pendente

## Dependências

- Sprint 1 concluída.
- Sprint 2 concluída.
- Fornecedores e produtos funcionando.
- Models e relacionamentos de compra disponíveis.

## Objetivo

Implementar todo o fluxo de compra, desde o orçamento com fornecedor até a confirmação da compra, entrada no estoque e registro da movimentação.

## Escopo

- Orçamento de compra.
- Itens do orçamento.
- Aprovação/cancelamento.
- Conversão em compra.
- Compra direta.
- Compra originada de orçamento.
- `OrcamentoCompraService`.
- `CompraService`.
- Confirmação da compra.
- Entrada no estoque.
- Movimentação `ENTRADA`.

## Tarefas

### Orçamento de Compra

- [ ] Criar `OrcamentoCompraController`.
- [ ] Criar Form Requests.
- [ ] Criar rotas.
- [ ] Criar listagem.
- [ ] Criar formulário de orçamento.
- [ ] Permitir selecionar fornecedor.
- [ ] Permitir adicionar vários produtos.
- [ ] Informar quantidade.
- [ ] Informar valor unitário.
- [ ] Calcular subtotal no backend.
- [ ] Calcular total no backend.
- [ ] Criar visualização detalhada do orçamento.
- [ ] Implementar status `PENDENTE`.
- [ ] Implementar aprovação.
- [ ] Implementar cancelamento conforme as regras do projeto.

### OrcamentoCompraService

- [ ] Criar `OrcamentoCompraService`.
- [ ] Implementar cálculo do total.
- [ ] Implementar aprovação.
- [ ] Implementar conversão de orçamento aprovado em compra.
- [ ] Copiar fornecedor.
- [ ] Copiar documento quando aplicável.
- [ ] Copiar itens.
- [ ] Copiar quantidades.
- [ ] Copiar valores unitários.
- [ ] Copiar subtotais.
- [ ] Recalcular total no backend.
- [ ] Relacionar compra ao orçamento.
- [ ] Marcar orçamento como `CONVERTIDO`.
- [ ] Garantir que a conversão não altere estoque.
- [ ] Impedir conversão duplicada.

### Compra

- [ ] Criar `CompraController`.
- [ ] Criar Form Requests.
- [ ] Criar rotas.
- [ ] Criar listagem de compras.
- [ ] Criar visualização detalhada.
- [ ] Permitir compra direta quando previsto no fluxo.
- [ ] Trabalhar com status `PENDENTE`, `CONFIRMADA` e `CANCELADA`.
- [ ] Impedir exclusão de compra confirmada.

### CompraService

- [ ] Criar `CompraService`.
- [ ] Usar `DB::transaction()`.
- [ ] Carregar produtos com `lockForUpdate()`.
- [ ] Verificar que a compra está `PENDENTE`.
- [ ] Guardar saldo anterior de cada produto.
- [ ] Somar as quantidades compradas.
- [ ] Atualizar `produtos.qtde_estoque`.
- [ ] Criar movimentação `ENTRADA`.
- [ ] Preencher saldo anterior.
- [ ] Preencher saldo posterior.
- [ ] Relacionar movimentação ao `compra_item_id`.
- [ ] Marcar a compra como `CONFIRMADA`.
- [ ] Garantir rollback completo em caso de erro.
- [ ] Impedir confirmação duplicada.
- [ ] Mostrar apenas aviso quando a compra ultrapassar `qtde_maxima`.

## Critérios de aceite

- [ ] Orçamento não altera estoque.
- [ ] Orçamento só é convertido quando `APROVADO`.
- [ ] Um orçamento gera no máximo uma compra.
- [ ] Compra `PENDENTE` não altera estoque.
- [ ] Compra `CONFIRMADA` aumenta estoque corretamente.
- [ ] Cada item gera no máximo uma movimentação.
- [ ] Movimentação criada é do tipo `ENTRADA`.
- [ ] Saldo anterior e posterior estão corretos.
- [ ] Confirmação duplicada é bloqueada.
- [ ] Falha durante confirmação executa rollback.
- [ ] Compra confirmada não pode ser excluída.

## Testes

### Orçamento

- [ ] Criar orçamento com vários produtos.
- [ ] Conferir subtotais.
- [ ] Conferir total.
- [ ] Aprovar orçamento.
- [ ] Converter orçamento em compra.
- [ ] Confirmar que estoque não mudou durante a conversão.
- [ ] Tentar converter o mesmo orçamento novamente.

### Compra

- [ ] Registrar estoque inicial.
- [ ] Confirmar uma compra.
- [ ] Conferir aumento do estoque.
- [ ] Conferir movimentação `ENTRADA`.
- [ ] Conferir saldo anterior.
- [ ] Conferir saldo posterior.
- [ ] Tentar confirmar a mesma compra novamente.
- [ ] Simular erro para garantir rollback quando aplicável.

## Entregáveis

- Módulo de Orçamento de Compra.
- `OrcamentoCompraService`.
- Módulo de Compra.
- `CompraService`.
- Entrada automática no estoque.
- Registro de movimentações de entrada.

## Observações

Registrar aqui decisões ou problemas encontrados durante a sprint.

---

# Sprint 07 — Documentação, revisão final e apresentação

## Responsável

**Integrante 3**

## Status

Pendente

## Dependências

- Sprints 1 a 6 concluídas.
- Sistema integrado e testado.

## Objetivo

Preparar o projeto para entrega e apresentação, garantindo que a documentação represente corretamente o sistema implementado e que o grupo esteja preparado para demonstrar o fluxo completo.

## Escopo

- Revisão do README.
- Revisão do `CONTEXTO.md`.
- Revisão do DER.
- Instruções de instalação.
- Roteiro de demonstração.
- Roteiro de apresentação.
- Revisão das tecnologias.
- Explicação da arquitetura.
- Preparação de exemplos para apresentação.

## Tarefas

### Documentação

- [ ] Revisar README do projeto.
- [ ] Conferir requisitos de instalação.
- [ ] Conferir comandos de instalação.
- [ ] Conferir configuração do PostgreSQL.
- [ ] Conferir comandos de migrations.
- [ ] Conferir configuração do frontend.
- [ ] Revisar referências ao DER.
- [ ] Revisar `Docs/CONTEXTO.md` para garantir que continua compatível com a implementação.
- [ ] Não alterar o DER sem decisão explícita do grupo/professor.

### Revisão do projeto

- [ ] Conferir a estrutura final de pastas.
- [ ] Conferir nomenclatura das classes.
- [ ] Conferir nomenclatura das tabelas.
- [ ] Conferir que não existem funcionalidades fora do escopo sem justificativa.
- [ ] Conferir que não existem credenciais no repositório.
- [ ] Conferir que `.env` continua ignorado.
- [ ] Conferir que o projeto pode ser instalado seguindo somente o README.

### Apresentação

- [ ] Preparar roteiro de apresentação.
- [ ] Preparar demonstração do cadastro.
- [ ] Preparar demonstração de orçamento de compra.
- [ ] Preparar demonstração da compra e entrada no estoque.
- [ ] Preparar demonstração de orçamento de venda.
- [ ] Preparar demonstração da venda e saída do estoque.
- [ ] Preparar demonstração das movimentações.
- [ ] Preparar demonstração do dashboard.
- [ ] Preparar explicação do DER.
- [ ] Preparar explicação de MVC.
- [ ] Preparar explicação dos Services.
- [ ] Preparar explicação de `DB::transaction()`.
- [ ] Preparar explicação de `lockForUpdate()`.
- [ ] Preparar exemplos de validações importantes.

### Preparação do grupo

- [ ] Garantir que todos entendam o fluxo completo.
- [ ] Definir divisão da fala.
- [ ] Realizar pelo menos um ensaio completo.
- [ ] Fazer uma instalação limpa do projeto antes da entrega final.

## Critérios de aceite

- [ ] README permite instalar e executar o projeto.
- [ ] Documentação corresponde ao código final.
- [ ] DER corresponde ao banco implementado.
- [ ] Projeto não contém credenciais.
- [ ] Demonstração completa pode ser executada sem ajustes manuais inesperados.
- [ ] Todos os integrantes conseguem explicar as regras centrais do estoque.
- [ ] O grupo consegue explicar por que orçamento não movimenta estoque.
- [ ] O grupo consegue explicar por que compra/venda confirmadas não são simplesmente excluídas.

## Testes finais

Em um ambiente limpo:

- [ ] clonar repositório;
- [ ] executar `composer install`;
- [ ] criar `.env`;
- [ ] criar banco PostgreSQL;
- [ ] executar migrations/seeders;
- [ ] executar `npm install`;
- [ ] executar `npm run dev`;
- [ ] executar `php artisan serve`;
- [ ] realizar fluxo completo de compra;
- [ ] realizar fluxo completo de venda;
- [ ] conferir estoque e movimentações.

## Entregáveis

- README final.
- Documentação revisada.
- Roteiro de apresentação.
- Projeto pronto para demonstração.
- Grupo preparado para explicar o sistema.

## Observações

Registrar aqui ajustes finais e pontos importantes para a apresentação.
