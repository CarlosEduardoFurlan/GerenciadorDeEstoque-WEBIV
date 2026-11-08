# Integrante 3 — Specs 003 e 007

Guia de responsabilidade ligado ao [roadmap geral](README.md) e ao
[contexto do projeto](../CONTEXTO.md). Os diretórios e branches abaixo são reservas para
trabalho futuro: nenhuma Spec é criada por este documento. As tarefas executáveis serão
geradas em `specs/<numero>-<feature>/tasks.md`; não duplicá-las neste guia.

## Spec 003 — Fornecedores

**Responsável:** Integrante 3. **Sprint:** 1.

**Diretório reservado:** `specs/003-fornecedores`.

**Branch:** `feature/003-fornecedores`.

**Escopo conhecido:**

- nome;
- documento;
- email;
- endereço;
- telefone;
- CRUD;
- validações.

**Dependências:** Relativamente independente de outras features de negócio; pode ser desenvolvida em paralelo, respeitando os critérios de implementação do roadmap.

**Pontos de clarificação:**

- Quais são a obrigatoriedade, o formato e a unicidade dos campos, quando não estiverem definidos no requisito?

Não assumir que `documento = CNPJ`. Regras ainda não definidas permanecem assuntos de Spec/Clarify; não impor formato ou unicidade por conta própria.

**Fluxo que o integrante executará futuramente:**

Partir da `development` atualizada e criar uma branch exclusiva para esta Spec:

```bash
git checkout development
git pull origin development
git checkout -b feature/003-fornecedores
```

Depois, no chat do Codex, informar o diretório explicitamente e descrever o escopo:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/003-fornecedores
```

Não depender da numeração automática. Conferir o diretório resolvido e o contexto ativo;
na sequência, executar uma etapa por vez, revisando cada resultado:

```text
$speckit-clarify
$speckit-plan
$speckit-checklist
$speckit-tasks
$speckit-analyze
$speckit-implement
$speckit-converge
```

`implement` só pode começar com clarificações críticas resolvidas, checklist adequado,
Spec/Plan/Tasks consistentes e dependências necessárias disponíveis. Aplicar as regras
de sincronização, testes, convergência e PR para `development` do [roadmap](README.md).
Os comandos acima são documentação futura; **não criar esta Spec agora**.

## Spec 007 — Contas a Pagar

**Responsável:** Integrante 3. **Sprint:** 2.

**Diretório reservado:** `specs/007-contas-pagar`.

**Branch:** `feature/007-contas-pagar`.

**Escopo conhecido:**

- documento;
- fornecedor;
- compra;
- data de vencimento;
- valor;
- data de pagamento.

**Dependências:** `003-fornecedores`, `004-formas-pagamento` e `005-compras`. A implementação exige a integração das dependências necessárias em `development`.

**Pontos de clarificação:**

- As contas são geradas automaticamente?
- Qual é a relação das parcelas com a forma de pagamento?
- Como os vencimentos são calculados?
- Qual é a relação entre `dia` e `data_vencimento`?
- Em qual momento as contas são criadas?

Coordenar as respostas com `004-formas-pagamento` e `005-compras`. Não implementar automação antes dessas respostas e não presumir que o vencimento equivale a `compra.data + dia`.

**Fluxo que o integrante executará futuramente:**

Partir da `development` atualizada e criar uma branch exclusiva para esta Spec:

```bash
git checkout development
git pull origin development
git checkout -b feature/007-contas-pagar
```

Depois, no chat do Codex, informar o diretório explicitamente e descrever o escopo:

```text
$speckit-specify
SPECIFY_FEATURE_DIRECTORY=specs/007-contas-pagar
```

Não depender da numeração automática. Conferir o diretório resolvido e o contexto ativo;
na sequência, executar uma etapa por vez, revisando cada resultado:

```text
$speckit-clarify
$speckit-plan
$speckit-checklist
$speckit-tasks
$speckit-analyze
$speckit-implement
$speckit-converge
```

`implement` só pode começar com clarificações críticas resolvidas, checklist adequado,
Spec/Plan/Tasks consistentes e dependências necessárias disponíveis. Aplicar as regras
de sincronização, testes, convergência e PR para `development` do [roadmap](README.md).
Os comandos acima são documentação futura; **não criar esta Spec agora**.
