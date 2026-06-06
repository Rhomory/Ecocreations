<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Guardamos el public_id devuelto por Cloudinary para poder borrar la
     * imagen del cloud cuando se elimine del catalogo.
     */
    public function up(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->string('cloudinary_public_id', 255)->nullable()->after('ruta');
        });

        Schema::table('product_variants', function (Blueprint $table) {
            $table->string('cloudinary_public_id', 255)->nullable()->after('imagen');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('imagen', 255)->nullable()->after('icono');
            $table->string('cloudinary_public_id', 255)->nullable()->after('imagen');
        });
    }

    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('cloudinary_public_id');
        });
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('cloudinary_public_id');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['imagen', 'cloudinary_public_id']);
        });
    }
};
