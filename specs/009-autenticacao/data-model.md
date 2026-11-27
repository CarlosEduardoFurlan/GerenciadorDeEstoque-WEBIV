# Modelo de dados: Autenticação

## Usuário (`users`)

Migration existente `0001_01_01_000000_create_users_table.php`:

| Campo | Regra |
|---|---|
| `id` | PK incremental |
| `name` | texto obrigatório |
| `email` | texto obrigatório, índice único |
| `email_verified_at` | data opcional, sem verificação obrigatória nesta feature |
| `password` | hash obrigatório |
| `remember_token` | opcional |
| `created_at`, `updated_at` | timestamps |

## Token de recuperação (`password_reset_tokens`)

`email` é PK e referencia logicamente o usuário; `token` contém hash e `created_at` permite expiração. Laravel Password Broker administra emissão, validade e consumo.

## Sessão (`sessions`)

`id` é PK; `user_id` opcional tem índice, `last_activity` tem índice. O middleware `auth` verifica a sessão; login regenera seu identificador e logout invalida a sessão e renova o token CSRF.

## Validação

- Registro: nome obrigatório, e-mail válido e único, senha confirmada e conforme regra padrão do Breeze.
- Login: e-mail válido e senha obrigatória; erros genéricos para credenciais inválidas.
- Recuperação: e-mail válido para solicitação; token e nova senha confirmada na conclusão.
