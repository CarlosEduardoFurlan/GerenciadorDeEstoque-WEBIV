# Sistema de Compras e Vendas Constitution

## Core Principles

### I. Requisitos do professor como fonte primária

Os requisitos e modelos atualizados fornecidos pelo professor DEVEM prevalecer sobre
decisões anteriores do projeto. Mudanças oficiais DEVEM atualizar primeiro a especificação
e a documentação, depois o plano, as tarefas e o código. A equipe NÃO DEVE inventar
funcionalidades, campos ou regras sem requisito confirmado. Isso mantém a entrega acadêmica
alinhada ao material recebido.

### II. Spec-Driven Development

Toda funcionalidade relevante DEVE começar por uma Spec. O fluxo padrão do grupo é:

```text
specify → clarify → plan → checklist → tasks → analyze → implement → converge
```

A implementação de uma feature NÃO DEVE começar antes de `spec.md`, `plan.md` e
`tasks.md` estarem consistentes, com os requisitos e as ambiguidades que afetam essa
implementação resolvidos. Os artefatos DEVEM ficar em `specs/`. O uso de IA não dispensa
a leitura e a revisão dos resultados pelo integrante responsável.

### III. Stack do projeto

O projeto DEVE manter PHP 8.3+, Laravel 13, PostgreSQL, Laravel Blade, Bootstrap 5 e
Vite. JavaScript DEVE ser usado somente quando necessário. A implementação DEVE seguir
o MVC convencional do Laravel, com Eloquent ORM, migrations, validação em Form Requests
e Services quando houver regras de negócio relevantes. Alterações de stack exigem
justificativa e revisão desta Constituição antes de alterar a aplicação.

### IV. Banco de dados

Toda estrutura do banco DEVE ser criada por migrations; tabelas NÃO DEVEM ser criadas
manualmente pelo pgAdmin. O Plan/Data Model DEVE definir PKs, FKs, unique constraints,
check constraints quando adequadas e índices quando necessários, conforme os requisitos
da feature. Valores monetários DEVEM usar NUMERIC/DECIMAL; FLOAT é proibido para dinheiro.
Tipos, precisões, relacionamentos técnicos e restrições específicas NÃO DEVEM ser
herdados automaticamente do DER anterior.

### V. Regras de negócio no backend

Regras críticas DEVEM ser validadas no backend. JavaScript pode melhorar a interface,
mas NÃO DEVE ser a única fonte de validação. Operações que alterarem simultaneamente
compra, produto, estoque ou financeiro DEVEM utilizar transações quando a atomicidade
for necessária para evitar alterações parciais. O Plan DEVE identificar essas operações
e como verificar sua consistência, depois da clarificação das regras aplicáveis.

### VI. Simplicidade

Por ser um projeto acadêmico, as decisões DEVEM priorizar clareza, organização,
facilidade de explicação, funcionamento correto e código Laravel convencional.
Repository Pattern sem necessidade, arquiteturas distribuídas, APIs desnecessárias,
abstrações sem justificativa e funcionalidades especulativas DEVEM ser evitados.
Complexidade adicional DEVE ter justificativa concreta no Plan e ser revisada pelo grupo.

### VII. Testabilidade

Cada Spec DEVE conter user stories quando aplicáveis, critérios de aceitação, cenários
independentes de teste, casos de erro e critérios mensuráveis de conclusão. O Plan e as
Tasks DEVEM indicar como validar esses critérios e registrar as evidências obtidas.
A conclusão NÃO DEVE depender apenas da afirmação de que o código foi gerado.

### VIII. Nomenclatura

O domínio DEVE permanecer em português, com nomes como `Categoria`, `Produto`,
`Fornecedor`, `FormaPagamento`, `Compra` e `ContaPagar`. Tabelas DEVEM usar português
e `snake_case`, com nomes explícitos quando necessário para evitar pluralização
inadequada do Eloquent. A equipe NÃO DEVE misturar inglês e português sem necessidade;
convenções e identificadores próprios do framework podem ser mantidos.

### IX. Governança dos requisitos

Quando um requisito mudar, a sequência obrigatória é:

```text
Requisito do professor → Spec → Plan → Tasks → Implementação
```

As Specs são a fonte detalhada de verdade dos requisitos das features, subordinadas ao
material atualizado do professor e a esta Constituição. `Docs/CONTEXTO.md` DEVE servir
como visão geral, histórico e registro do estado atual; NÃO DEVE substituir as Specs.
`Docs/Sprints/README.md` DEVE funcionar apenas como roadmap; tarefas executáveis NÃO
DEVEM ser duplicadas manualmente nele. Documentos em `Docs/Legado/` são históricos e
NÃO DEVEM orientar novas implementações como requisitos vigentes.

## Limites do escopo atual

O material vigente é `Projeto Sistema Compras e Vendas`, seção `DE COMPRA`, conforme
registrado em `Docs/CONTEXTO.md`. Contas a pagar fazem parte explicitamente do escopo.
A parte de vendas permanece **AGUARDANDO REQUISITOS ATUALIZADOS DO PROFESSOR**.
O DER anterior NÃO representa mais o modelo oficial; um novo DER definitivo somente
poderá ser consolidado após as clarificações e os Plans/Data Models correspondentes.

A média aritmética para atualização do custo, os gatilhos de atualização de estoque e
preços, o parcelamento e a geração de contas a pagar NÃO DEVEM receber fórmulas ou
comportamentos presumidos. As dúvidas DEVEM ser resolvidas com o professor ou em
`$speckit-clarify`, registrando a origem da decisão na Spec afetada.

Na Sprint 0, a equipe DEVE preparar processo e documentação, sem criar Specs 001–008,
migrations, Models, Controllers, Services, Form Requests, Views ou rotas de negócio.

## Fluxo e critérios de revisão

Cada integrante DEVE executar no chat do Codex, uma etapa por vez:

```text
$speckit-specify
$speckit-clarify
$speckit-plan
$speckit-checklist
$speckit-tasks
$speckit-analyze
$speckit-implement
$speckit-converge
```

Antes da implementação, a revisão DEVE verificar aderência ao requisito atualizado,
resolução das ambiguidades pertinentes, consistência entre Spec/Plan/Tasks, conformidade
com esta Constituição e critérios verificáveis. Antes da integração, DEVE verificar
as evidências de validação, a documentação e a convergência da feature. Se `converge`
identificar trabalho restante, o responsável DEVE revisar as tarefas geradas e repetir
`implement → converge` até atender aos critérios da Spec. A revisão cruzada segue o roadmap.

## Governance

Esta Constituição rege o processo do projeto e substitui o planejamento anterior como
orientação ativa, respeitando a prioridade dos requisitos atualizados do professor.
Toda proposta de alteração DEVE registrar motivo, origem e impacto nas Specs, nos Plans,
nas Tasks e no código, ser revisada pelo grupo e atualizar a versão e a data de emenda.
Nenhuma alteração documental autoriza inventar requisitos ausentes do material recebido.

A versão segue SemVer: MAJOR para remoção ou redefinição incompatível de princípios;
MINOR para novos princípios ou ampliação material da governança; PATCH para correções
e esclarecimentos sem mudança de significado. Toda revisão de Plan e de Pull Request
DEVE verificar conformidade; desvios DEVEM ser resolvidos antes da implementação ou
integração. A documentação operacional está no README e no roadmap de Sprints.

**Version**: 1.0.0 | **Ratified**: 2026-11-07 | **Last Amended**: 2026-11-07
