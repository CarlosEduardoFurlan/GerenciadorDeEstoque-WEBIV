# Tasks: Autenticação

**Input**: [spec.md](spec.md), [plan.md](plan.md), [research.md](research.md), [data-model.md](data-model.md), [contracts/routes-and-ui.md](contracts/routes-and-ui.md)

## Phase 1: Setup

- [x] T001 Integrar `laravel/breeze` 2.4.2 em `composer.json` e `composer.lock`, executar `php artisan breeze:install blade` e conferir a saída gerada.
- [x] T002 Manter Bootstrap 5 no `package.json` e no Vite; adaptar arquivos gerados sem introduzir Tailwind como stack final.

## Phase 2: Foundation

- [x] T003 Revisar os controllers e requests Breeze em `app/Http/Controllers/Auth/` e `app/Http/Requests/Auth/LoginRequest.php` para cadastro público e validação.
- [x] T004 Integrar `routes/auth.php` a `routes/web.php`, remover o fallback temporário de `/login` e proteger `/` com middleware `auth`.

## Phase 3: US1 e US1A — Registro e entrada

- [x] T005 Adaptar `resources/views/auth/register.blade.php` e `resources/views/auth/login.blade.php` a Bootstrap 5, com CSRF, erros e links úteis.
- [x] T006 Criar testes Feature em `tests/Feature/Auth/` para registro, e-mail duplicado, login válido/inválido e acesso direto às rotas protegidas.

## Phase 4: US2 — Saída

- [x] T007 Integrar saída POST em `resources/views/template.blade.php` e testar invalidação de sessão.

## Phase 5: US3 — Recuperação

- [x] T008 Adaptar `resources/views/auth/forgot-password.blade.php` e `reset-password.blade.php` ao Bootstrap 5 e testar solicitação, link válido/inválido e nova senha.

## Phase 6: Convergência

- [ ] T009 Executar todos os testes Feature e `npm run build`; validar [quickstart.md](quickstart.md). Testes PHP executáveis; build Node aguarda instalação dos pacotes.
- [ ] T010 Conferir `git diff`, estado da branch, ausência de `.env` e credenciais; abrir PR de `feature/009-autenticacao` para `development` após T001–T009.

## Dependencies & Execution Order

T001 desbloqueia a implementação. T003–T004 precedem T005–T008; T009–T010 são gates finais. A Spec 001 depende da integração da 009 para demonstrar as rotas protegidas.
