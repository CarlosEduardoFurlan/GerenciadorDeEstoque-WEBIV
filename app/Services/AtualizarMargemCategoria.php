<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AtualizarMargemCategoria
{
    public function atualizar(Categoria $categoria, array $dados): void
    {
        DB::transaction(function () use ($categoria, $dados): void {
            $categoria->fill($dados);
            $margemMudou = $categoria->isDirty('margem_lucro');
            $categoria->save();

            // A Spec 002 criará a tabela de produtos após este cadastro.
            if (! $margemMudou || ! Schema::hasTable('produto')) {
                return;
            }

            DB::table('produto')->where('categoria_id', $categoria->id)
                ->orderBy('id')->chunkById(100, function ($produtos) use ($categoria): void {
                    foreach ($produtos as $produto) {
                        DB::table('produto')->where('id', $produto->id)->update([
                            'valor_venda' => self::calcularPreco($produto->valor_compra, $categoria->margem_lucro),
                        ]);
                    }
                });
        });
    }

    public static function calcularPreco(string $valorCompra, string $margem): string
    {
        $custo = self::centavos($valorCompra);
        $percentual = self::centavos($margem);
        $preco = intdiv($custo * (10000 + $percentual) + 5000, 10000);

        return sprintf('%d.%02d', intdiv($preco, 100), $preco % 100);
    }

    private static function centavos(string $decimal): int
    {
        [$inteiro, $fracao] = array_pad(explode('.', $decimal, 2), 2, '');

        return ((int) $inteiro * 100) + (int) str_pad($fracao, 2, '0');
    }
}
