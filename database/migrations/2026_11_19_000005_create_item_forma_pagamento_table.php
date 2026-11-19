<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_forma_pagamento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forma_pagamento_id')
                ->constrained('forma_pagamento')
                ->cascadeOnDelete();
            $table->index('forma_pagamento_id');
            $table->decimal('porcentagem', 5, 2);
            $table->unsignedInteger('dia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_forma_pagamento');
    }
};
