<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use App\Services\AtualizarMargemCategoria;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    private function criarProdutoTabela(): void
    {
        Schema::create('produto', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categoria')->restrictOnDelete();
            $table->decimal('valor_compra', 12, 2);
            $table->decimal('valor_venda', 12, 2);
        });
    }

    public function test_rotas_de_categoria_exigem_login(): void
    {
        $this->get('/categorias')->assertRedirect('/login');
        $this->get('/categorias/nova')->assertRedirect('/login');
        $this->post('/categorias')->assertRedirect('/login');
        $this->put('/categorias/1')->assertRedirect('/login');
        $this->delete('/categorias/1')->assertRedirect('/login');
    }

    public function test_cadastro_e_validacao(): void
    {
        $this->actingAs(User::factory()->create())
            ->post('/categorias', ['descricao' => 'Bebidas', 'margem_lucro' => '30.00'])
            ->assertRedirect(route('categorias.index'));

        $this->assertDatabaseHas('categoria', ['descricao' => 'Bebidas', 'margem_lucro' => 30]);

        $this->from('/categorias/nova')->post('/categorias', [
            'descricao' => '', 'margem_lucro' => '-1',
        ])->assertRedirect('/categorias/nova')->assertSessionHasErrors(['descricao', 'margem_lucro']);

        $this->assertDatabaseCount('categoria', 1);
    }

    public function test_listagem_vazia_e_paginada_em_dez(): void
    {
        $this->actingAs(User::factory()->create())->get('/categorias')
            ->assertOk()->assertSee('Nenhuma categoria cadastrada.');

        foreach (range(1, 11) as $numero) {
            Categoria::create(['descricao' => sprintf('Categoria %02d', $numero), 'margem_lucro' => 20]);
        }

        $this->get('/categorias')->assertViewHas('categorias', fn ($itens) => $itens->count() === 10 && $itens->total() === 11)
            ->assertSee('Categoria 01')->assertDontSee('Categoria 11');
        $this->get('/categorias?page=2')->assertViewHas('categorias', fn ($itens) => $itens->count() === 1)
            ->assertSee('Categoria 11');
    }

    public function test_alteracao_da_margem_atualiza_produtos_desta_categoria_com_centavos_exatos(): void
    {
        $this->criarProdutoTabela();
        $primeira = Categoria::create(['descricao' => 'Primeira', 'margem_lucro' => 10]);
        $segunda = Categoria::create(['descricao' => 'Segunda', 'margem_lucro' => 10]);
        DB::table('produto')->insert([
            ['categoria_id' => $primeira->id, 'valor_compra' => '100.00', 'valor_venda' => '110.00'],
            ['categoria_id' => $primeira->id, 'valor_compra' => '0.05', 'valor_venda' => '0.06'],
            ['categoria_id' => $segunda->id, 'valor_compra' => '100.00', 'valor_venda' => '110.00'],
        ]);

        $this->actingAs(User::factory()->create())->put(route('categorias.update', $primeira), [
            'descricao' => 'Primeira', 'margem_lucro' => '30.00',
        ])->assertRedirect(route('categorias.index'));

        $this->assertDatabaseHas('categoria', ['id' => $primeira->id, 'margem_lucro' => 30]);
        $this->assertDatabaseHas('produto', ['categoria_id' => $primeira->id, 'valor_compra' => 100, 'valor_venda' => 130]);
        $this->assertDatabaseHas('produto', ['categoria_id' => $primeira->id, 'valor_compra' => 0.05, 'valor_venda' => 0.07]);
        $this->assertDatabaseHas('produto', ['categoria_id' => $segunda->id, 'valor_venda' => 110]);
    }

    public function test_editar_apenas_descricao_preserva_precos_e_dados_invalidos_nao_alteram_nada(): void
    {
        $this->criarProdutoTabela();
        $categoria = Categoria::create(['descricao' => 'Antiga', 'margem_lucro' => 10]);
        DB::table('produto')->insert(['categoria_id' => $categoria->id, 'valor_compra' => '100.00', 'valor_venda' => '111.00']);
        $this->actingAs(User::factory()->create())->put(route('categorias.update', $categoria), [
            'descricao' => 'Nova', 'margem_lucro' => '10.00',
        ])->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('produto', ['valor_venda' => 111]);

        $this->put(route('categorias.update', $categoria), [
            'descricao' => '', 'margem_lucro' => '1000.00',
        ])->assertSessionHasErrors(['descricao', 'margem_lucro']);
        $this->assertDatabaseHas('categoria', ['id' => $categoria->id, 'descricao' => 'Nova', 'margem_lucro' => 10]);
        $this->assertDatabaseHas('produto', ['valor_venda' => 111]);
    }

    public function test_exclusao_de_categoria_com_produto_e_bloqueada(): void
    {
        $this->criarProdutoTabela();
        $categoria = Categoria::create(['descricao' => 'Com produto', 'margem_lucro' => 20]);
        DB::table('produto')->insert(['categoria_id' => $categoria->id, 'valor_compra' => 100, 'valor_venda' => 120]);

        $this->actingAs(User::factory()->create())->delete(route('categorias.destroy', $categoria))
            ->assertRedirect(route('categorias.index'))->assertSessionHas('error');
        $this->assertDatabaseHas('categoria', ['id' => $categoria->id]);
    }

    public function test_falha_ao_recalcular_um_produto_reverte_margem_e_precos(): void
    {
        $this->criarProdutoTabela();
        $categoria = Categoria::create(['descricao' => 'Teste de transação', 'margem_lucro' => 10]);
        DB::table('produto')->insert([
            ['categoria_id' => $categoria->id, 'valor_compra' => '100.00', 'valor_venda' => '110.00'],
            ['categoria_id' => $categoria->id, 'valor_compra' => '200.00', 'valor_venda' => '220.00'],
        ]);
        DB::statement("CREATE TRIGGER impedir_recalculo BEFORE UPDATE ON produto WHEN NEW.valor_venda = 260 BEGIN SELECT RAISE(ABORT, 'falha simulada'); END");

        $this->withoutExceptionHandling();

        try {
            $this->actingAs(User::factory()->create())->put(route('categorias.update', $categoria), [
                'descricao' => 'Teste de transação', 'margem_lucro' => 30,
            ]);
            $this->fail('A falha simulada deveria interromper o recálculo.');
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->assertStringContainsString('falha simulada', $exception->getMessage());
        }

        $this->assertDatabaseHas('categoria', ['id' => $categoria->id, 'margem_lucro' => 10]);
        $this->assertDatabaseHas('produto', ['valor_compra' => 100, 'valor_venda' => 110]);
        $this->assertDatabaseHas('produto', ['valor_compra' => 200, 'valor_venda' => 220]);
    }

    public function test_exclusao_sem_produto_e_alteracao_antes_da_spec_002(): void
    {
        $categoria = Categoria::create(['descricao' => 'Sem produto', 'margem_lucro' => 20]);
        $this->actingAs(User::factory()->create())->put(route('categorias.update', $categoria), [
            'descricao' => 'Sem produto', 'margem_lucro' => 30,
        ])->assertRedirect(route('categorias.index'));
        $this->delete(route('categorias.destroy', $categoria))->assertSessionHas('success');
        $this->assertDatabaseCount('categoria', 0);
    }

    public function test_calculo_de_preco_nao_usa_float_para_dinheiro(): void
    {
        $this->assertSame('130.00', AtualizarMargemCategoria::calcularPreco('100.00', '30.00'));
        $this->assertSame('0.07', AtualizarMargemCategoria::calcularPreco('0.05', '30.00'));
        $this->assertSame('0.00', AtualizarMargemCategoria::calcularPreco('0.00', '0.00'));
    }
}
