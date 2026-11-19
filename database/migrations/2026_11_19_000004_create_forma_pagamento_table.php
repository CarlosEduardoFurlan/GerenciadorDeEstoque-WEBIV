<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forma_pagamento', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 255)->index();
            $table->unsignedInteger('numero_parcelas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forma_pagamento');
    }
};
