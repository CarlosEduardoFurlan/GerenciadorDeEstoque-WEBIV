# Pesquisa e decisões: Autenticação

## Cadastro público

- **Decisão**: Pessoas sem conta podem se registrar pela tela de entrada; nome, e-mail único e senha confirmada são obrigatórios.
- **Motivo**: Clarificação do integrante 1 em 2026-11-26.
- **Alternativa**: Cadastro restrito a administradores foi descartado.

## Base de autenticação

- **Decisão**: Usar o scaffolding Blade do Laravel Breeze, preservando sua autenticação por sessão, recuperação de senha e validação; adaptar somente as views para Bootstrap 5 e a navegação do projeto.
- **Motivo**: Constitution exige Breeze e a stack de interface é Bootstrap. O pacote Breeze 2.x declara compatibilidade com `illuminate/* ^13.0`.
- **Alternativa**: Criar autenticação própria ou usar outro starter kit violaria a exigência do projeto.

## Integração com a aplicação

- **Decisão**: Manter as rotas de fornecedor e formas de pagamento no grupo `auth`; proteger a página inicial e remover o fallback temporário de `/login`.
- **Motivo**: A página inicial é a entrada operacional e as rotas atuais já usam `auth`.
- **Alternativa**: Deixar a tela de boas-vindas pública não atenderia à exigência de acesso protegido à área principal.

## Persistência e teste

- **Decisão**: Reutilizar `users`, `password_reset_tokens` e `sessions` já presentes em migrations. Usar SQLite em memória nos testes e envio falso de notificações para recuperação.
- **Motivo**: Evita migrações duplicadas e permite testar os fluxos completos.
- **Alternativa**: Novas tabelas ou credenciais fixas não são necessárias.

## Restrição do ambiente

`composer require laravel/breeze --dev` falhou inicialmente porque este ambiente não alcançou `repo.packagist.org`. Em seguida, o diretório principal recebeu `composer.json` e `composer.lock` com Breeze 2.4.2 e o pacote foi encontrado em `vendor/`. Esses arquivos foram copiados para a branch isolada; `php artisan breeze:install blade --no-interaction` gerou o scaffolding oficial. A etapa automática de `npm install` foi interrompida pela indisponibilidade de rede; a interface gerada foi adaptada para Bootstrap 5 e depende apenas dos pacotes Node já declarados pelo projeto.
