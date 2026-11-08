# Registro da adoção do Spec Kit e da organização documental

Atualizado em 2026-11-07. A adoção do GitHub Spec Kit foi concluída e integrada na
`development` pelo PR #3, commit `ab5cbac`. Este documento registra o estado do processo;
não substitui os requisitos do [contexto](CONTEXTO.md) nem o [roadmap](Sprints/README.md).

## Estado da adoção

- Specify CLI 1.3.2, integração oficial `codex`, com nove skills compartilháveis em
  `.agents/skills/` e infraestrutura em `.specify/`.
- Constitution 1.0.0 com os nove princípios do projeto, preservada integralmente nesta
  reorganização. Nenhum template, script, manifest ou skill do Spec Kit foi alterado.
- Laravel Boost não faz parte da stack. A inclusão inicial, motivada pelo bootstrap
  preexistente do `AGENTS.md`, já havia sido removida na auditoria da adoção. As dependências
  não foram alteradas nesta tarefa documental e nenhuma instalação foi executada.
- Não existe DER definitivo: os requisitos que afetam sua definição ainda aguardam
  clarificação. O material documental antigo foi removido da árvore do projeto por
  solicitação do grupo; os commits anteriores permanecem no histórico Git.
- Nenhuma feature foi implementada e nenhum diretório `specs/` foi criado. Os números
  001–008 são reservas; não criar Specs 009+ enquanto vendas aguarda requisitos atualizados.

## Organização atual

```text
Docs/
├── ADOCAO-SPEC-KIT.md
├── CONTEXTO.md
└── Sprints/
    ├── README.md
    ├── INTEGRANTE-1-SPECS-001-005.md
    ├── INTEGRANTE-2-SPECS-002-006.md
    ├── INTEGRANTE-3-SPECS-003-007.md
    └── INTEGRANTE-4-SPECS-004-008.md
```

O contexto mantém os requisitos conhecidos e as dez ambiguidades abertas. O roadmap
organiza Sprints, responsabilidades e prevenção de conflitos. Os quatro guias por
integrante registram escopos conhecidos, dependências, clarificações e o fluxo futuro.
As tarefas executáveis serão geradas apenas em `specs/<numero>-<feature>/tasks.md`.
Não duplicar tarefas em `Docs/Sprints/`.

## Fluxo Git adotado

```text
feature/spec → development → main
```

Cada feature nasce da `development` atualizada e abre PR para `development`. Somente
versões consolidadas seguem de `development` para `main`. Uma branch por Spec, com nome
`feature/XXX-nome` e diretório explícito `SPECIFY_FEATURE_DIRECTORY=specs/XXX-nome`.
O grupo recomenda merge de `development` para a feature para sincronizar dependências;
esses comandos são orientações futuras e não foram executados nesta reorganização.

Esta reorganização foi preparada na branch `docs/organizacao-specs`, criada a partir
da `development` atualizada. Nenhum commit, push ou merge foi feito nesta tarefa.

## Limites e verificações da reorganização

A alteração está limitada a documentação: README, instruções compartilhadas dos agentes,
contexto, este registro, roadmap e os quatro guias por integrante. Não foram executadas
skills de criação, planejamento, geração de tarefas ou implementação de features.

Os requisitos do professor e as dez perguntas de clarificação foram preservados. Contas
a pagar continuam no escopo e a Sprint 3 permanece bloqueada, aguardando os requisitos
atualizados de venda do professor. Não foram criados Model, migration, Controller,
Service, Form Request, View, rota ou DER.

A Constitution foi preservada por proibição expressa de alteração. Uma menção histórica
ao antigo diretório documental permanece no seu texto; ela não autoriza restaurar o
material removido nem utilizá-lo como modelo ativo. As referências dos demais documentos
editáveis foram atualizadas para a organização vigente.

| Verificação | Resultado |
|---|---|
| `php artisan test` | 2 testes passaram, com 2 assertions; chave efêmera somente no processo |
| `specify integration status` | Integração `codex` OK, sem arquivos gerenciados modificados ou ausentes |
| Constituição e infraestrutura Spec Kit | Sem diff em `.specify/` ou `.agents/` |
| Código e dependências | Nenhuma alteração; nenhuma dependência instalada |

As verificações documentais incluem a estrutura de sete arquivos em `Docs/`, links
locais, preservação dos requisitos e das ambiguidades e ausência de Specs de feature.
A validação do PostgreSQL e a instalação em outro computador continuam sendo
responsabilidade de cada integrante e não são presumidas por esta organização documental.

## Avisos externos previamente documentados

A auditoria anterior registrou sete avisos preexistentes em quatro pacotes Symfony:
http-foundation 8.1.8 (quatro), http-kernel 8.1.8 (um), mime 8.1.7 (um) e routing 8.1.8
(um). Permanecem somente documentados. Esta tarefa não executa `composer update`, upgrades
ou correções externas à reorganização da documentação.
