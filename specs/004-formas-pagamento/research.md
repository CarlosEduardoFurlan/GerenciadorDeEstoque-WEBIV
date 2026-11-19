# Research: Formas de Pagamento

## Decisão 1 — Persistência da relação 1:N

- **Decision**: Usar as tabelas `forma_pagamento` e `item_forma_pagamento`, com `forma_pagamento_id` obrigatório e exclusão em cascata dos itens.
- **Rationale**: Representa diretamente o modelo conceitual confirmado, impede itens órfãos e segue o padrão de tabelas em português do projeto.
- **Alternatives considered**: Armazenar itens em JSON dificultaria integridade, consultas e uso futuro por compras/vendas; uma única tabela repetiria a descrição e o número de parcelas.

## Decisão 2 — Precisão da porcentagem

- **Decision**: Persistir `porcentagem` como decimal com duas casas e validar a soma usando aritmética decimal normalizada em centésimos.
- **Rationale**: Evita erro de ponto flutuante na regra de total exato de 100% e suporta distribuições como 33,33%, 33,33% e 33,34%.
- **Alternatives considered**: `float` pode produzir somas imprecisas; somente inteiros impediria percentuais fracionários sem requisito para isso.

## Decisão 3 — Validação das regras cruzadas

- **Decision**: Usar `FormaPagamentoRequest` para validar campos e, após as regras básicas, verificar que a quantidade de itens coincide com `numero_parcelas` e que a soma das porcentagens é 100%.
- **Rationale**: Mantém todas as submissões protegidas no backend e produz erros associados ao formulário antes de iniciar persistência.
- **Alternatives considered**: JavaScript isolado não atende à Constitution; validação somente no controller dispersaria responsabilidades.

## Decisão 4 — Atualização dos itens

- **Decision**: Em uma transação, atualizar a forma, substituir sua coleção de itens pela coleção validada e confirmar tudo junto.
- **Rationale**: O conjunto de itens é pequeno, pertence exclusivamente à forma e precisa permanecer coerente como unidade.
- **Alternatives considered**: Sincronização item a item exigiria identificadores expostos e lógica adicional sem benefício para o escopo acadêmico.

## Decisão 5 — Autenticação

- **Decision**: Colocar todas as rotas da feature no grupo `auth` já existente, preservando o fallback temporário de login enquanto a Spec 009 não estiver integrada.
- **Rationale**: Satisfaz a proteção disponível na `development` sem instalar ou duplicar o Laravel Breeze, que pertence à Spec 009.
- **Alternatives considered**: Instalar Breeze nesta branch violaria a divisão das Specs; deixar rotas públicas contrariaria o requisito transversal.

## Decisão 6 — Interface e rotas

- **Decision**: Usar páginas Blade com Bootstrap 5, rotas web nomeadas e verbos HTTP adequados para listar, criar, visualizar, editar e excluir.
- **Rationale**: É consistente com a stack, permite redirecionamentos e mensagens de sessão e mantém a interface simples.
- **Alternatives considered**: API ou frontend separado adicionariam tecnologia e complexidade não previstas.

