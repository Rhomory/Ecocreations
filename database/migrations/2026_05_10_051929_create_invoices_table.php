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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained()->onDelete('cascade');
            $table->string('numero', 20)->unique();
            $table->enum('tipo', ['boleta', 'factura']);
            $table->string('ruc', 11)->nullable();
            $table->string('razon_social', 200)->nullable();
            $table->string('pdf_path', 255)->nullable();
            $table->dateTime('emitida_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
