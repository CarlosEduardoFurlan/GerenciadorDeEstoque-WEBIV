<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormaPagamento extends Model
{
    protected $table = 'forma_pagamento';

    protected $fillable = [
        'descricao',
        'numero_parcelas',
    ];

    protected function casts(): array
    {
        return [
            'numero_parcelas' => 'integer',
        ];
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemFormaPagamento::class)
            ->orderBy('dia')
            ->orderBy('id');
    }
}
