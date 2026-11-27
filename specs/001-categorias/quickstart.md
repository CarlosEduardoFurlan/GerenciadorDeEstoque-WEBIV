# Quickstart: Categorias

1. Em `feature/001-categorias` a partir de `development`, instalar dependências e executar migrations SQLite. A autenticação definitiva chegará pela Spec 009; testes podem usar usuários autenticados do framework.
2. Executar testes da categoria e toda a suíte com `php artisan test` em PHP com `pdo_sqlite` habilitado.
3. Abrir `/categorias` autenticado. Cadastrar categoria com descrição e margem 30,00; verificar listagem, edição e paginação após onze registros.
4. Com a Spec 002 integrada, criar produto de custo R$ 100,00 nessa categoria, alterar margem para 30,00% e conferir preço R$ 130,00. Outra categoria não pode ser afetada.
5. Tentar excluir categoria que contenha produto: a operação deve ser recusada. Categoria sem produtos deve ser excluída.
