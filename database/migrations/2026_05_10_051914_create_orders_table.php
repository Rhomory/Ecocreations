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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('numero_orden', 20)->unique();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->foreignId('address_id')->constrained()->onDelete('restrict');
            $table->foreignId('payment_method_id')->constrained()->onDelete('restrict');
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('descuento', 8, 2)->default(0);
            $table->decimal('igv', 8, 2);
            $table->decimal('envio', 6, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->enum('estado', [
                'pendiente',
                'pagado',
                'preparando',
                'enviado',
                'entregado',
                'cancelado'
            ])->default('pendiente');
            $table->text('notas')->nullable();

            // ---- Campos para integracion Niubiz (sandbox o produccion) ----
            $table->string('niubiz_purchase_number', 50)->nullable();   // ID unico de transaccion
            $table->string('niubiz_transaction_id', 100)->nullable();   // ID de Niubiz
            $table->string('niubiz_action_code', 10)->nullable();       // 000 = aprobado
            $table->json('niubiz_response')->nullable();                // respuesta completa para auditoria/debug
            $table->dateTime('pagado_at')->nullable();                  // momento del cobro exitoso

            $table->timestamps();

            $table->index('estado');
            $table->index('numero_orden');
            $table->index('niubiz_purchase_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
