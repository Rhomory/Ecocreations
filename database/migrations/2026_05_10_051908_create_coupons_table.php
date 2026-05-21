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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->enum('tipo', ['porcentaje', 'monto_fijo']);
            $table->decimal('valor', 8, 2);
            $table->decimal('min_compra', 8, 2)->default(0);
            $table->dateTime('valido_desde');
            $table->dateTime('valido_hasta');
            $table->integer('usos_max')->nullable();
            $table->integer('usos_actuales')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index(['valido_desde', 'valido_hasta']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
