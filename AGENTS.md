# Instruções do projeto

## Fontes e processo

- Ler `.specify/memory/constitution.md`, `Docs/CONTEXTO.md` e
  `Docs/Sprints/README.md` antes de planejar ou implementar features.
- Os requisitos atualizados do professor têm prioridade. A seção recebida é `DE COMPRA`;
  vendas está AGUARDANDO REQUISITOS ATUALIZADOS DO PROFESSOR.
- Seguir Spec Kit com integração `codex`: specify → clarify → plan → checklist → tasks
  → analyze → implement → converge. Spec, Plan e Tasks devem estar consistentes antes
  da implementação; os artefatos detalhados ficarão em `specs/`.
- `Docs/Legado/` é somente histórico. Não usar o DER ou os checklists antigos como
  fonte oficial. Não presumir respostas às dez ambiguidades registradas no contexto.
- A Sprint 0 de adoção prepara somente processo e documentação: não criar Specs 001–008
  nem código de negócio nessa tarefa. A divisão futura dos quatro integrantes está no roadmap.

## Stack e convenções

- Manter PHP 8.3+, Laravel 13, PostgreSQL, Blade, Bootstrap 5 e Vite.
  JavaScript somente quando necessário. Seguir MVC, Eloquent, migrations, Form Requests
  e Services quando houver regras relevantes, conforme a Constitution.
- Laravel Boost não integra a stack e não é requisito do Spec Kit ou da integração Codex.
  Não instalar Boost nem alterar dependências para preparar o fluxo de Specs.
- Preservar a estrutura e as convenções existentes do Laravel; priorizar clareza,
  organização e facilidade de explicação, sem funcionalidades especulativas.
- Não atualizar dependências fora do escopo solicitado. Avisos preexistentes devem ser
  documentados; não executar upgrades amplos para esta adoção.

## Verificação e Git

- Consultar `git status` antes de editar e preservar alterações existentes do usuário.
- Executar os testes existentes ao verificar mudanças e informar falhas ou limitações.
  Não criar testes ou código de negócio nesta adoção.
- Usar `specify integration status` para verificar a integração Codex.
- Não versionar `.env`, credenciais ou estado local `.specify/feature.json`.
- Não fazer commit, push ou merge sem instrução do usuário.
