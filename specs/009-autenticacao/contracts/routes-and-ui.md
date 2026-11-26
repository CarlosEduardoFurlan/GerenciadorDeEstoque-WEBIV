# Contrato de rotas e interface: Autenticação

| Método | URI | Nome | Acesso | Resultado |
|---|---|---|---|---|
| GET | `/login` | `login` | visitante | formulário de entrada |
| POST | `/login` | — | visitante | sessão iniciada e redirecionamento ao destino |
| GET | `/register` | `register` | visitante | formulário de cadastro |
| POST | `/register` | — | visitante | novo usuário e sessão iniciada |
| GET | `/forgot-password` | `password.request` | visitante | formulário de recuperação |
| POST | `/forgot-password` | `password.email` | visitante | link enviado ou status apropriado |
| GET | `/reset-password/{token}` | `password.reset` | visitante | formulário de nova senha |
| POST | `/reset-password` | `password.store` | visitante | senha alterada ou erros |
| POST | `/logout` | `logout` | autenticado | sessão encerrada |
| GET | `/` | `dashboard` | autenticado | navegação aos cadastros |

As rotas existentes de fornecedores e formas de pagamento permanecem no middleware `auth`. Formulários usam CSRF, mensagens de validação e Bootstrap 5. A tela de login oferece links de cadastro e recuperação; o menu autenticado oferece ação de saída via POST.
