<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        Schema::table('carts', function (Blueprint $table) {
            $table->string('session_id', 100)->nullable()->after('user_id');
        });

        // SQLite (usado en tests) no soporta dropUnique/ALTER COLUMN del mismo modo.
        // En ese caso recreamos la tabla limpia.
        if ($driver === 'sqlite') {
            // SQLite: recrear tabla sin unique en user_id y con user_id nullable.
            Schema::drop('carts');
            Schema::create('carts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
                $table->string('session_id', 100)->nullable();
                $table->timestamps();
                $table->index('user_id');
                $table->index('session_id');
            });
            return;
        }

        // En MySQL no se puede dropear el unique mientras la FK lo usa: hay que
        // soltar la FK primero, modificar el unique/columna, y recrear la FK.
        if ($driver === 'mysql' || $driver === 'mariadb') {
            Schema::table('carts', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropUnique(['user_id']);
            });

            DB::statement('ALTER TABLE carts MODIFY user_id BIGINT UNSIGNED NULL');

            Schema::table('carts', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->index('session_id');
                $table->index('user_id');
            });
            return;
        }

        // Postgres
        Schema::table('carts', function (Blueprint $table) {
            $table->dropUnique(['user_id']);
        });

        DB::statement('ALTER TABLE carts ALTER COLUMN user_id DROP NOT NULL');

        Schema::table('carts', function (Blueprint $table) {
            $table->index('session_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'sqlite') {
            Schema::drop('carts');
            Schema::create('carts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
                $table->timestamps();
            });
            return;
        }

        if ($driver === 'mysql' || $driver === 'mariadb') {
            Schema::table('carts', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropIndex(['session_id']);
                $table->dropIndex(['user_id']);
                $table->dropColumn('session_id');
            });

            DB::statement('ALTER TABLE carts MODIFY user_id BIGINT UNSIGNED NOT NULL');

            Schema::table('carts', function (Blueprint $table) {
                $table->unique('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
            return;
        }

        Schema::table('carts', function (Blueprint $table) {
            $table->dropIndex(['session_id']);
            $table->dropIndex(['user_id']);
            $table->dropColumn('session_id');
        });

        DB::statement('ALTER TABLE carts ALTER COLUMN user_id SET NOT NULL');

        Schema::table('carts', function (Blueprint $table) {
            $table->unique('user_id');
        });
    }
};
