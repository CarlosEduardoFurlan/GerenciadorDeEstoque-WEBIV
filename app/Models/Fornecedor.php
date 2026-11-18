<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de domínio para fornecedores do sistema de compras.
 */
class Fornecedor extends Model
{
    protected $table = 'fornecedor';

    protected $fillable = [
        'nome',
        'documento',
        'email',
        'endereco',
        'telefone',
    ];
}
