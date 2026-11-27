<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    protected $fillable = ['descricao', 'margem_lucro'];

    protected function casts(): array
    {
        return ['margem_lucro' => 'decimal:2'];
    }
}
