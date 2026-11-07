# Integrante 4 — Sprints 00 e 04

Responsabilidade principal: **ambiente, repositório e fluxo completo de vendas**.

---

# Sprint 00 — Ambiente e repositório

## Responsável

**Integrante 4**

## Status

Em finalização

## Objetivo

Garantir que o projeto possa ser clonado e executado por todos os integrantes em seus próprios computadores antes do início das funcionalidades.

## Escopo

- Repositório Git.
- Laravel.
- PostgreSQL.
- `.env.example`.
- Bootstrap 5.
- Vite.
- README de instalação.
- Documentação inicial.
- Fluxo básico de branches.
- Teste de instalação em outra máquina.

## Tarefas

### Repositório

- [x] Projeto Laravel versionado.
- [x] `.gitignore` configurado.
- [x] `.env` ignorado.
- [x] `composer.lock` versionado.
- [x] `package-lock.json` versionado.
- [x] `Docs/CONTEXTO.md` versionado.
- [x] `Docs/DER.jpg` versionado.

### Ambiente

- [x] `.env.example` configurado para PostgreSQL.
- [x] Banco padrão definido como `controle_estoque`.
- [x] Locale padrão definido como `pt_BR`.
- [x] Faker definido como `pt_BR`.
- [x] Nome da aplicação definido como `Controle de Estoque`.
- [x] Timezone definido como `America/Campo_Grande`.
- [x] Bootstrap 5 configurado.
- [x] Tailwind removido da configuração do frontend.
- [x] README com instruções de instalação criado.

### Verificação do grupo

- [ ] Todos os quatro integrantes foram adicionados/possuem acesso adequado ao repositório.
- [ ] Cada integrante configurou nome e e-mail do Git.
- [ ] Cada integrante consegue clonar o repositório.
- [ ] Cada integrante consegue executar `composer install`.
- [ ] Cada integrante consegue criar o próprio `.env`.
- [ ] Cada integrante criou localmente o banco `controle_estoque`.
- [ ] Cada integrante consegue executar `php artisan migrate`.
- [ ] Cada integrante consegue executar `npm install`.
- [ ] Cada integrante consegue executar `npm run dev`.
- [ ] Cada integrante consegue executar `php artisan serve`.
- [ ] A aplicação abre em `http://127.0.0.1:8000` em outro computador.
- [ ] Cada integrante consegue criar e enviar uma branch própria.
- [ ] Proteção de branch/ruleset foi configurada manualmente no GitHub, se adotada pelo grupo.

## Critérios de aceite

- [ ] Um integrante que não criou o projeto consegue instalá-lo seguindo apenas o README.
- [ ] Nenhuma credencial pessoal está versionada.
- [ ] PostgreSQL é utilizado no ambiente local.
- [ ] Migrations padrão executam sem erro.
- [ ] Frontend compila com Bootstrap 5.
- [ ] Aplicação abre corretamente.

## Teste final da Sprint 0

Em um segundo computador:

```bash
git clone https://github.com/CarlosEduardoFurlan/GerenciadorDeEstoque-WEBIV.git
cd GerenciadorDeEstoque-WEBIV

composer install
```

Criar o `.env`, gerar a chave e configurar as credenciais locais do PostgreSQL.

Depois:

```bash
php artisan key:generate
php artisan config:clear
php artisan migrate
npm install
npm run dev
```

Em outro terminal:

```bash
php artisan serve
```

- [ ] Instalação limpa concluída com sucesso.

## Entregáveis

- Ambiente reproduzível.
- Configuração compartilhável via `.env.example`.
- README de instalação.
- Bootstrap 5 configurado.
- Projeto pronto para a Sprint 1.

## Observações

A Sprint 0 só deve ser marcada como concluída depois do teste de instalação em outro computador.

---

# Sprint 04 — Fluxo completo de vendas

## Responsável

**Integrante 4**

## Status

Pendente

## Dependências

- Sprint 1 concluída.
- Sprint 2 concluída.
- Sprint 3 integrada.
- Clientes e produtos funcionando.
- Models e relacionamentos de venda disponíveis.

## Objetivo

Implementar todo o fluxo de venda, desde o orçamento enviado ao cliente até a confirmação, saída do estoque e registro da movimentação.

## Escopo

- Orçamento de venda.
- Itens do orçamento.
- Aprovação/cancelamento.
- Conversão em venda.
- Venda direta.
- Venda originada de orçamento.
- `OrcamentoVendaService`.
- `VendaService`.
- Verificação de estoque.
- Confirmação da venda.
- Saída do estoque.
- Movimentação `SAIDA`.

## Tarefas

### Orçamento de Venda

- [ ] Criar `OrcamentoVendaController`.
- [ ] Criar Form Requests.
- [ ] Criar rotas.
- [ ] Criar listagem.
- [ ] Criar formulário de orçamento.
- [ ] Permitir selecionar cliente.
- [ ] Permitir adicionar vários produtos.
- [ ] Informar quantidade.
- [ ] Utilizar preço de venda como valor inicial quando apropriado.
- [ ] Calcular subtotal no backend.
- [ ] Calcular total no backend.
- [ ] Criar visualização detalhada.
- [ ] Implementar status `PENDENTE`.
- [ ] Implementar aprovação.
- [ ] Implementar cancelamento conforme as regras do projeto.

### OrcamentoVendaService

- [ ] Criar `OrcamentoVendaService`.
- [ ] Implementar cálculo do total.
- [ ] Implementar aprovação.
- [ ] Implementar conversão de orçamento aprovado em venda.
- [ ] Copiar cliente.
- [ ] Copiar itens.
- [ ] Copiar quantidades.
- [ ] Copiar preços.
- [ ] Copiar subtotais.
- [ ] Recalcular total no backend.
- [ ] Relacionar venda ao orçamento.
- [ ] Marcar orçamento como `CONVERTIDO`.
- [ ] Garantir que a conversão não altere estoque.
- [ ] Impedir conversão duplicada.

### Venda

- [ ] Criar `VendaController`.
- [ ] Criar Form Requests.
- [ ] Criar rotas.
- [ ] Criar listagem.
- [ ] Criar visualização detalhada.
- [ ] Permitir venda direta quando previsto no fluxo.
- [ ] Trabalhar com status `PENDENTE`, `CONFIRMADA` e `CANCELADA`.
- [ ] Impedir exclusão de venda confirmada.

### VendaService

- [ ] Criar `VendaService`.
- [ ] Usar `DB::transaction()`.
- [ ] Carregar produtos com `lockForUpdate()`.
- [ ] Verificar que a venda está `PENDENTE`.
- [ ] Conferir estoque de todos os itens antes de efetivar a operação.
- [ ] Impedir estoque negativo.
- [ ] Guardar saldo anterior.
- [ ] Subtrair quantidade vendida.
- [ ] Atualizar `produtos.qtde_estoque`.
- [ ] Criar movimentação `SAIDA`.
- [ ] Preencher saldo anterior.
- [ ] Preencher saldo posterior.
- [ ] Relacionar movimentação ao `venda_item_id`.
- [ ] Marcar venda como `CONFIRMADA`.
- [ ] Executar rollback total se qualquer produto estiver sem estoque suficiente.
- [ ] Impedir confirmação duplicada.

## Critérios de aceite

- [ ] Orçamento não altera estoque.
- [ ] Orçamento só é convertido quando `APROVADO`.
- [ ] Um orçamento gera no máximo uma venda.
- [ ] Venda `PENDENTE` não altera estoque.
- [ ] Venda só é confirmada se todos os itens tiverem estoque suficiente.
- [ ] Nenhum item é processado parcialmente.
- [ ] Estoque nunca fica negativo.
- [ ] Movimentação criada é do tipo `SAIDA`.
- [ ] Saldo anterior e posterior estão corretos.
- [ ] Confirmação duplicada é bloqueada.
- [ ] Venda confirmada não pode ser excluída.

## Testes

### Orçamento

- [ ] Criar orçamento com vários produtos.
- [ ] Conferir subtotais.
- [ ] Conferir total.
- [ ] Aprovar orçamento.
- [ ] Converter em venda.
- [ ] Confirmar que estoque não mudou durante a conversão.
- [ ] Tentar converter o mesmo orçamento novamente.

### Venda

- [ ] Registrar estoque inicial.
- [ ] Confirmar venda com estoque suficiente.
- [ ] Conferir redução do estoque.
- [ ] Conferir movimentação `SAIDA`.
- [ ] Conferir saldo anterior.
- [ ] Conferir saldo posterior.
- [ ] Tentar vender quantidade maior que o estoque.
- [ ] Verificar que nenhum item foi alterado após falha.
- [ ] Tentar confirmar a mesma venda novamente.

## Entregáveis

- Módulo de Orçamento de Venda.
- `OrcamentoVendaService`.
- Módulo de Venda.
- `VendaService`.
- Saída automática do estoque.
- Registro de movimentações de saída.

## Observações

Registrar aqui decisões ou problemas encontrados durante a sprint.
