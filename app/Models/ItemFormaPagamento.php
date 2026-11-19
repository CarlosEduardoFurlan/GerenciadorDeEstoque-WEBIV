<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemFormaPagamento extends Model
{
    protected $table = 'item_forma_pagamento';

    protected $fillable = [
        'porcentagem',
        'dia',
    ];

    protected function casts(): array
    {
        return [
            'porcentagem' => 'decimal:2',
            'dia' => 'integer',
        ];
    }

    public function formaPagamento(): BelongsTo
    {
        return $this->belongsTo(FormaPagamento::class);
    }
}
