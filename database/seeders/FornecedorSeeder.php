<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use Illuminate\Database\Seeder;

/**
 * Popula a tabela fornecedor com 15 registros fictícios para validar a paginação.
 */
class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Fornecedor::create([
                'nome' => fake('pt_BR')->company(),
                'documento' => fake('pt_BR')->numerify('##.###.###/0001-##'),
                'email' => fake()->unique()->companyEmail(),
                'endereco' => fake('pt_BR')->streetAddress(),
                'telefone' => fake('pt_BR')->phoneNumber(),
            ]);
        }
    }
}
