<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->string('nombre', 150);
            $table->string('slug', 170)->unique();
            $table->string('descripcion_corta', 300);
            $table->text('descripcion_larga');
            $table->decimal('precio_base', 8, 2);
            $table->boolean('es_personalizable')->default(false);
            $table->boolean('es_destacado')->default(false);
            $table->string('material', 100)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index('activo');
            $table->index('es_destacado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
