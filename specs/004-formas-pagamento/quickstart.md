# Quickstart: Validação da Spec 004

## Pré-requisitos

- PHP 8.3 ou superior;
- dependências instaladas com `composer install`;
- `.env` configurado para SQLite;
- banco SQLite disponível;
- usuário de teste existente quando a interface for validada manualmente.

## Preparação

```powershell
php artisan migrate
php artisan test --filter=FormaPagamentoTest
```

O teste deve terminar sem falhas antes da validação manual.

## Cenário 1 — Cadastro válido

1. Autenticar-se e abrir `/formas-pagamento/novo`.
2. Informar descrição `30/60 dias` e `2` parcelas.
3. Informar os itens `50,00% / 30 dias` e `50,00% / 60 dias`.
4. Salvar.

**Esperado**: mensagem de sucesso; a listagem mostra a forma e os detalhes exibem os dois itens.

## Cenário 2 — Quantidade divergente

1. Tentar cadastrar `3` parcelas com apenas `2` itens.

**Esperado**: operação rejeitada, mensagem sobre um item por parcela, dados preenchidos preservados e nenhum registro parcial.

## Cenário 3 — Porcentagem diferente de 100%

1. Tentar cadastrar dois itens com `40,00%` cada.

**Esperado**: operação rejeitada, mensagem sobre o total de 100%, dados preservados e nenhum registro parcial.

## Cenário 4 — Alteração atômica

1. Editar a forma do cenário 1 para três parcelas com itens `30,00% / 30`, `30,00% / 60` e `40,00% / 90`.
2. Conferir os detalhes.

**Esperado**: três itens atualizados, soma 100% e nenhum item antigo remanescente.

## Cenário 5 — Paginação

1. Garantir a existência de 11 formas válidas.
2. Abrir a listagem e navegar para a segunda página.

**Esperado**: no máximo 10 registros na primeira página e os demais acessíveis na segunda.

## Cenário 6 — Exclusão

1. Excluir uma forma após confirmar a ação.

**Esperado**: forma e itens removidos, mensagem de sucesso e retorno à listagem.

## Cenário 7 — Autorização

1. Encerrar a sessão.
2. Tentar acessar `/formas-pagamento`.

**Esperado**: redirecionamento para login; nenhuma tela de gerenciamento é exibida anonimamente.

## Validação completa

```powershell
php artisan test
```

Todos os testes do projeto devem passar sem regressões.

