# Planejamento das Sprints

Este diretório organiza o desenvolvimento do **Sistema de Controle de Estoque** por integrante e por sprint.

O planejamento geral do projeto continua definido em [../CONTEXTO.md](../CONTEXTO.md) e o modelo de dados oficial está em [../DER.jpg](../DER.jpg).

## Forma de trabalho

Não serão utilizadas GitHub Issues para acompanhar as tarefas.

Cada integrante possui um arquivo Markdown próprio com as duas sprints sob sua responsabilidade. O próprio arquivo funciona como checklist da execução.

Ao concluir uma tarefa, altere:

```text
- [ ] Tarefa pendente
```

para:

```text
- [x] Tarefa concluída
```

O responsável também deve atualizar o campo **Status** da sprint quando necessário.

## Divisão das sprints

| Integrante | Sprints | Responsabilidade principal |
|---|---|---|
| Integrante 1 | Sprint 1 e Sprint 5 | Banco, Models, estoque e dashboard |
| Integrante 2 | Sprint 2 e Sprint 6 | Layout, CRUDs, validações e testes |
| Integrante 3 | Sprint 3 e Sprint 7 | Compras, documentação e apresentação |
| Integrante 4 | Sprint 0 e Sprint 4 | Ambiente, repositório e vendas |

## Arquivos

- [Integrante 1 — Sprints 01 e 05](INTEGRANTE-1-SPRINTS-01-05.md)
- [Integrante 2 — Sprints 02 e 06](INTEGRANTE-2-SPRINTS-02-06.md)
- [Integrante 3 — Sprints 03 e 07](INTEGRANTE-3-SPRINTS-03-07.md)
- [Integrante 4 — Sprints 00 e 04](INTEGRANTE-4-SPRINTS-00-04.md)

## Ordem geral

As sprints devem ser integradas nesta ordem:

```text
Sprint 0
   ↓
Sprint 1
   ↓
Sprint 2
   ↓
Sprint 3
   ↓
Sprint 4
   ↓
Sprint 5
   ↓
Sprint 6
   ↓
Sprint 7
```

A existência de responsáveis diferentes não significa que todas as sprints devam ser integradas ao mesmo tempo. Cada sprint depende do estado estável das anteriores.

## Fluxo de Git recomendado

Cada sprint deve ser desenvolvida em branch própria.

Exemplos:

```text
sprint/01-banco-models
sprint/02-layout-cruds
sprint/03-compras
sprint/04-vendas
sprint/05-estoque-dashboard
sprint/06-testes-validacoes
sprint/07-documentacao
```

Ao iniciar uma sprint:

```bash
git checkout main
git pull origin main
git checkout -b sprint/XX-nome-da-sprint
```

Ao concluir:

```bash
git add .
git commit -m "feat: conclui sprint XX"
git push -u origin sprint/XX-nome-da-sprint
```

Depois, abrir Pull Request para revisão antes do merge na branch estável.

## Regra de conclusão

Uma sprint só deve ser marcada como **Concluída** quando:

- todas as tarefas obrigatórias estiverem marcadas;
- os critérios de aceite forem atendidos;
- os testes indicados tiverem sido executados;
- o código estiver integrado sem quebrar a aplicação;
- o responsável registrar observações importantes no próprio arquivo da sprint.
