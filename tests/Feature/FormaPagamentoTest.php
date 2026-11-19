<?php

namespace Tests\Feature;

use App\Models\FormaPagamento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormaPagamentoTest extends TestCase
{
    use RefreshDatabase;

    private function criarFormaPagamento(array $overrides = [], array $itens = []): FormaPagamento
    {
        $formaPagamento = FormaPagamento::create(array_merge([
            'descricao' => '30/60 dias',
            'numero_parcelas' => 2,
        ], $overrides));

        $formaPagamento->itens()->createMany($itens ?: [
            ['porcentagem' => '50.00', 'dia' => 30],
            ['porcentagem' => '50.00', 'dia' => 60],
        ]);

        return $formaPagamento->load('itens');
    }

    public function test_rotas_de_formas_de_pagamento_exigem_autenticacao(): void
    {
        $this->get('/formas-pagamento')->assertRedirect('/login');
        $this->get('/formas-pagamento/novo')->assertRedirect('/login');
        $this->post('/formas-pagamento')->assertRedirect('/login');
        $this->get('/formas-pagamento/1')->assertRedirect('/login');
        $this->get('/formas-pagamento/1/editar')->assertRedirect('/login');
        $this->put('/formas-pagamento/1')->assertRedirect('/login');
        $this->delete('/formas-pagamento/1')->assertRedirect('/login');
    }

    public function test_usuario_autenticado_pode_cadastrar_forma_com_um_item_por_parcela(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/formas-pagamento/novo')
            ->assertOk()
            ->assertSee('Nova Forma de Pagamento');

        $response = $this->actingAs($user)->post('/formas-pagamento', [
            'descricao' => '30/60/90 dias',
            'numero_parcelas' => 3,
            'itens' => [
                ['porcentagem' => '30.00', 'dia' => 30],
                ['porcentagem' => '30.00', 'dia' => 60],
                ['porcentagem' => '40.00', 'dia' => 90],
            ],
        ]);

        $response->assertRedirect(route('formas-pagamento.index'));
        $response->assertSessionHas('success', 'Forma de pagamento cadastrada com sucesso.');
        $this->assertDatabaseHas('forma_pagamento', [
            'descricao' => '30/60/90 dias',
            'numero_parcelas' => 3,
        ]);
        $this->assertDatabaseCount('item_forma_pagamento', 3);
        $this->assertDatabaseHas('item_forma_pagamento', [
            'porcentagem' => 40,
            'dia' => 90,
        ]);
    }

    public function test_cadastro_rejeita_campos_obrigatorios_sem_persistir_dados_parciais(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from('/formas-pagamento/novo')
            ->post('/formas-pagamento', [
                'descricao' => '',
                'numero_parcelas' => '',
                'itens' => [],
            ]);

        $response->assertRedirect('/formas-pagamento/novo');
        $response->assertSessionHasErrors(['descricao', 'numero_parcelas', 'itens']);
        $this->assertDatabaseCount('forma_pagamento', 0);
        $this->assertDatabaseCount('item_forma_pagamento', 0);
    }

    public function test_cadastro_rejeita_quantidade_de_itens_diferente_do_numero_de_parcelas(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from('/formas-pagamento/novo')
            ->post('/formas-pagamento', [
                'descricao' => 'Três parcelas incompletas',
                'numero_parcelas' => 3,
                'itens' => [
                    ['porcentagem' => '50.00', 'dia' => 30],
                    ['porcentagem' => '50.00', 'dia' => 60],
                ],
            ]);

        $response->assertRedirect('/formas-pagamento/novo');
        $response->assertSessionHasErrors([
            'itens' => 'A quantidade de itens deve ser igual ao número de parcelas.',
        ]);
        $this->assertDatabaseCount('forma_pagamento', 0);

        $this->actingAs($user)
            ->get('/formas-pagamento/novo')
            ->assertSee('Três parcelas incompletas');
    }

    public function test_cadastro_rejeita_porcentagens_que_nao_totalizam_cem(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/formas-pagamento', [
            'descricao' => 'Total inválido',
            'numero_parcelas' => 2,
            'itens' => [
                ['porcentagem' => '40.00', 'dia' => 30],
                ['porcentagem' => '40.00', 'dia' => 60],
            ],
        ]);

        $response->assertSessionHasErrors([
            'itens' => 'A soma das porcentagens deve ser exatamente 100%.',
        ]);
        $this->assertDatabaseCount('forma_pagamento', 0);
    }

    public function test_cadastro_rejeita_dia_negativo_ou_nao_inteiro(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/formas-pagamento', [
            'descricao' => 'Dias inválidos',
            'numero_parcelas' => 2,
            'itens' => [
                ['porcentagem' => '50.00', 'dia' => -1],
                ['porcentagem' => '50.00', 'dia' => '30.5'],
            ],
        ]);

        $response->assertSessionHasErrors(['itens.0.dia', 'itens.1.dia']);
        $this->assertDatabaseCount('forma_pagamento', 0);
    }

    public function test_listagem_exibe_estado_vazio_e_pagina_de_dez_em_dez(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/formas-pagamento')
            ->assertOk()
            ->assertSee('Nenhuma forma de pagamento cadastrada.');

        foreach (range(1, 11) as $indice) {
            $this->criarFormaPagamento([
                'descricao' => sprintf('Forma %02d', $indice),
            ]);
        }

        $pagina1 = $this->actingAs($user)->get('/formas-pagamento');
        $pagina1->assertOk();
        $pagina1->assertViewHas('formasPagamento', fn ($formas) => $formas->count() === 10 && $formas->total() === 11);
        $pagina1->assertSee('Forma 01');
        $pagina1->assertDontSee('Forma 11');

        $pagina2 = $this->actingAs($user)->get('/formas-pagamento?page=2');
        $pagina2->assertOk();
        $pagina2->assertViewHas('formasPagamento', fn ($formas) => $formas->count() === 1);
        $pagina2->assertSee('Forma 11');
    }

    public function test_usuario_pode_visualizar_forma_e_seus_itens(): void
    {
        $user = User::factory()->create();
        $formaPagamento = $this->criarFormaPagamento();

        $this->actingAs($user)
            ->get("/formas-pagamento/{$formaPagamento->id}")
            ->assertOk()
            ->assertSee('30/60 dias')
            ->assertSee('50,00%')
            ->assertSee('30 dias')
            ->assertSee('60 dias');
    }

    public function test_usuario_pode_atualizar_forma_substituindo_itens_atomicamente(): void
    {
        $user = User::factory()->create();
        $formaPagamento = $this->criarFormaPagamento();
        $idsAntigos = $formaPagamento->itens->pluck('id')->all();

        $response = $this->actingAs($user)->put("/formas-pagamento/{$formaPagamento->id}", [
            'descricao' => '30/60/90 dias',
            'numero_parcelas' => 3,
            'itens' => [
                ['porcentagem' => '33.33', 'dia' => 30],
                ['porcentagem' => '33.33', 'dia' => 60],
                ['porcentagem' => '33.34', 'dia' => 90],
            ],
        ]);

        $response->assertRedirect(route('formas-pagamento.index'));
        $response->assertSessionHas('success', 'Forma de pagamento atualizada com sucesso.');
        $this->assertDatabaseHas('forma_pagamento', [
            'id' => $formaPagamento->id,
            'descricao' => '30/60/90 dias',
            'numero_parcelas' => 3,
        ]);
        $this->assertDatabaseCount('item_forma_pagamento', 3);

        foreach ($idsAntigos as $idAntigo) {
            $this->assertDatabaseMissing('item_forma_pagamento', ['id' => $idAntigo]);
        }
    }

    public function test_alteracao_invalida_mantem_forma_e_itens_anteriores(): void
    {
        $user = User::factory()->create();
        $formaPagamento = $this->criarFormaPagamento();

        $response = $this->actingAs($user)
            ->from("/formas-pagamento/{$formaPagamento->id}/editar")
            ->put("/formas-pagamento/{$formaPagamento->id}", [
                'descricao' => 'Alteração inválida',
                'numero_parcelas' => 2,
                'itens' => [
                    ['porcentagem' => '25.00', 'dia' => 10],
                    ['porcentagem' => '25.00', 'dia' => 20],
                ],
            ]);

        $response->assertRedirect("/formas-pagamento/{$formaPagamento->id}/editar");
        $response->assertSessionHasErrors('itens');
        $this->assertDatabaseHas('forma_pagamento', [
            'id' => $formaPagamento->id,
            'descricao' => '30/60 dias',
            'numero_parcelas' => 2,
        ]);
        $this->assertDatabaseCount('item_forma_pagamento', 2);
        $this->assertDatabaseHas('item_forma_pagamento', ['dia' => 30, 'porcentagem' => 50]);
        $this->assertDatabaseHas('item_forma_pagamento', ['dia' => 60, 'porcentagem' => 50]);
    }

    public function test_usuario_pode_excluir_forma_e_seus_itens(): void
    {
        $user = User::factory()->create();
        $formaPagamento = $this->criarFormaPagamento();

        $response = $this->actingAs($user)->delete("/formas-pagamento/{$formaPagamento->id}");

        $response->assertRedirect(route('formas-pagamento.index'));
        $response->assertSessionHas('success', 'Forma de pagamento excluída com sucesso.');
        $this->assertDatabaseMissing('forma_pagamento', ['id' => $formaPagamento->id]);
        $this->assertDatabaseCount('item_forma_pagamento', 0);
    }
}
