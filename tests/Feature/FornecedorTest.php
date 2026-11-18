<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use App\Models\User;
use Database\Seeders\FornecedorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FornecedorTest extends TestCase
{
    use RefreshDatabase;

    private function criarFornecedor(array $overrides = []): Fornecedor
    {
        return Fornecedor::create(array_merge([
            'nome' => 'Fornecedor Padrão Ltda',
            'documento' => '12.345.678/0001-90',
            'email' => 'contato@fornecedor.test',
            'endereco' => 'Rua Exemplo, 100 - Centro',
            'telefone' => '(18) 3222-1000',
        ], $overrides));
    }

    public function test_rotas_de_fornecedor_exigem_autenticacao(): void
    {
        $this->get('/fornecedor/listar')->assertRedirect('/login');
        $this->get('/fornecedor/novo')->assertRedirect('/login');
        $this->post('/fornecedor/salvar', [])->assertRedirect('/login');
        $this->get('/fornecedor/editar/1')->assertRedirect('/login');
        $this->get('/fornecedor/excluir/1')->assertRedirect('/login');
    }

    public function test_listagem_exibe_estado_vazio_quando_nao_ha_fornecedores(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/fornecedor/listar');

        $response->assertStatus(200);
        $response->assertSee('Listagem de Fornecedores');
        $response->assertSee('Nenhum fornecedor cadastrado.');
    }

    public function test_listagem_ordena_por_nome_e_pagina_de_10_em_10(): void
    {
        $user = User::factory()->create();

        for ($i = 15; $i >= 1; $i--) {
            $numero = str_pad((string) $i, 2, '0', STR_PAD_LEFT);
            $this->criarFornecedor([
                'nome' => "Fornecedor {$numero}",
                'email' => "fornecedor{$numero}@empresa.test",
            ]);
        }

        $pagina1 = $this->actingAs($user)->get('/fornecedor/listar');
        $pagina1->assertStatus(200);
        $pagina1->assertViewHas('fornecedores', fn ($fornecedores) => $fornecedores->count() === 10 && $fornecedores->total() === 15);
        $pagina1->assertSeeInOrder(['Fornecedor 01', 'Fornecedor 05', 'Fornecedor 10']);
        $pagina1->assertDontSee('Fornecedor 11');
        $pagina1->assertSee('<ul class="pagination"', false);

        $pagina2 = $this->actingAs($user)->get('/fornecedor/listar?page=2');
        $pagina2->assertStatus(200);
        $pagina2->assertViewHas('fornecedores', fn ($fornecedores) => $fornecedores->count() === 5);
        $pagina2->assertSee('Fornecedor 11');
        $pagina2->assertSee('Fornecedor 15');
        $pagina2->assertDontSee('Fornecedor 01');
    }

    public function test_usuario_autenticado_pode_cadastrar_novo_fornecedor(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/fornecedor/novo')
            ->assertStatus(200)
            ->assertSee('Cadastro de Fornecedor');

        $payload = [
            'id' => 0,
            'nome' => 'Distribuidora Alfa',
            'documento' => '11.222.333/0001-44',
            'email' => 'alfa@distribuidora.test',
            'endereco' => 'Av. Brasil, 500',
            'telefone' => '(18) 99999-1111',
        ];

        $response = $this->actingAs($user)->post('/fornecedor/salvar', $payload);

        $response->assertRedirect('/fornecedor/listar');
        $this->assertDatabaseHas('fornecedor', [
            'nome' => 'Distribuidora Alfa',
            'documento' => '11.222.333/0001-44',
            'email' => 'alfa@distribuidora.test',
            'endereco' => 'Av. Brasil, 500',
            'telefone' => '(18) 99999-1111',
        ]);
    }

    public function test_cadastro_rejeita_campos_obrigatorios_vazios_e_email_invalido_preservando_old(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from('/fornecedor/novo')
            ->post('/fornecedor/salvar', [
                'id' => 0,
                'nome' => '',
                'documento' => '12345678900',
                'email' => 'email-invalido',
                'endereco' => '',
                'telefone' => '',
            ]);

        $response->assertRedirect('/fornecedor/novo');
        $response->assertSessionHasErrors([
            'nome' => 'Nome é obrigatório.',
            'email' => 'E-mail inválido.',
            'endereco' => 'Endereço é obrigatório.',
            'telefone' => 'Telefone é obrigatório.',
        ]);
        $this->assertDatabaseCount('fornecedor', 0);

        $redirected = $this->actingAs($user)->get('/fornecedor/novo');
        $redirected->assertSee('12345678900');
        $redirected->assertSee('email-invalido');
    }

    public function test_usuario_autenticado_pode_visualizar_e_atualizar_fornecedor_existente(): void
    {
        $user = User::factory()->create();
        $fornecedor = $this->criarFornecedor([
            'nome' => 'Fornecedor Original',
            'email' => 'original@fornecedor.test',
        ]);

        $this->actingAs($user)
            ->get("/fornecedor/editar/{$fornecedor->id}")
            ->assertStatus(200)
            ->assertSee('Fornecedor Original')
            ->assertSee('original@fornecedor.test');

        $response = $this->actingAs($user)->post('/fornecedor/salvar', [
            'id' => $fornecedor->id,
            'nome' => 'Fornecedor Atualizado',
            'documento' => '99.888.777/0001-66',
            'email' => 'atualizado@fornecedor.test',
            'endereco' => 'Rua Nova, 200',
            'telefone' => '(18) 98888-7777',
        ]);

        $response->assertRedirect('/fornecedor/listar');
        $this->assertDatabaseCount('fornecedor', 1);
        $this->assertDatabaseHas('fornecedor', [
            'id' => $fornecedor->id,
            'nome' => 'Fornecedor Atualizado',
            'documento' => '99.888.777/0001-66',
            'email' => 'atualizado@fornecedor.test',
            'endereco' => 'Rua Nova, 200',
            'telefone' => '(18) 98888-7777',
        ]);
    }

    public function test_edicao_rejeita_dados_invalidos_sem_alterar_banco_e_preserva_old(): void
    {
        $user = User::factory()->create();
        $fornecedor = $this->criarFornecedor([
            'nome' => 'Fornecedor Intacto',
            'email' => 'intacto@fornecedor.test',
        ]);

        $response = $this->actingAs($user)
            ->from("/fornecedor/editar/{$fornecedor->id}")
            ->post('/fornecedor/salvar', [
                'id' => $fornecedor->id,
                'nome' => '',
                'documento' => '77788899900',
                'email' => 'invalido',
                'endereco' => 'Rua Alterada, 10',
                'telefone' => '(18) 90000-0000',
            ]);

        $response->assertRedirect("/fornecedor/editar/{$fornecedor->id}");
        $response->assertSessionHasErrors(['nome', 'email']);
        $this->assertDatabaseHas('fornecedor', [
            'id' => $fornecedor->id,
            'nome' => 'Fornecedor Intacto',
            'email' => 'intacto@fornecedor.test',
        ]);

        $redirected = $this->actingAs($user)->get("/fornecedor/editar/{$fornecedor->id}");
        $redirected->assertSee('77788899900');
        $redirected->assertSee('Rua Alterada, 10');
    }

    public function test_editar_fornecedor_inexistente_retorna_404(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/fornecedor/editar/99999')
            ->assertStatus(404);
    }

    public function test_usuario_autenticado_pode_excluir_fornecedor_existente(): void
    {
        $user = User::factory()->create();
        $fornecedor = $this->criarFornecedor(['nome' => 'Fornecedor Removível']);

        $response = $this->actingAs($user)->get("/fornecedor/excluir/{$fornecedor->id}");

        $response->assertRedirect('/fornecedor/listar');
        $this->assertDatabaseMissing('fornecedor', ['id' => $fornecedor->id]);
    }

    public function test_excluir_fornecedor_inexistente_retorna_404(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/fornecedor/excluir/99999')
            ->assertStatus(404);
    }

    public function test_seeder_popula_15_fornecedores(): void
    {
        $this->seed(FornecedorSeeder::class);

        $this->assertDatabaseCount('fornecedor', 15);
    }
}
