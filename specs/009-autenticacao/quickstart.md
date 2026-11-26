# Quickstart: validação da Spec 009

1. Em `feature/009-autenticacao`, instalar dependências com `composer install` e executar `php artisan migrate` em SQLite. Breeze 2.4.2 já consta no lockfile; seu scaffolding já foi aplicado.
2. Executar `php -d extension=php_pdo_sqlite.dll vendor/phpunit/phpunit/phpunit` neste ambiente Windows, ou `php artisan test` em ambiente com `pdo_sqlite` configurado no PHP. Esperado: testes existentes e de autenticação passam. Na cópia isolada de testes foi necessário configurar temporariamente `APP_BASE_PATH` e o autoload do checkout porque `vendor` aponta para o diretório principal; isso não faz parte do código entregue.
3. Executar `npm install` e `npm run build`; iniciar `php artisan serve`.
4. Abrir `/` sem sessão. Esperado: redirecionamento ao login.
5. Criar uma conta pelo link da tela de login. Esperado: entrada na área inicial e acesso aos cadastros.
6. Sair e abrir diretamente `/formas-pagamento` ou `/fornecedor/listar`. Esperado: redirecionamento ao login; após entrar, retorno ao destino.
7. Solicitar recuperação de senha. Em desenvolvimento, consultar o log de e-mail (`MAIL_MAILER=log`), abrir o link e salvar nova senha. Esperado: login com a nova senha.

Não utilizar credenciais fixas ou publicar `.env`.
