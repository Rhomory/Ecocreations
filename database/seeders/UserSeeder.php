<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Administrador ECO',
            'email' => 'admin@ecocreations.pe',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('client_profiles')->insert([
            'user_id' => $adminId,
            'dni' => '12345678',
            'telefono' => '999111222',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Cliente demo
        $clienteId = DB::table('users')->insertGetId([
            'name' => 'Brayan Cliente',
            'email' => 'cliente@demo.pe',
            'password' => Hash::make('cliente123'),
            'role' => 'cliente',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('client_profiles')->insert([
            'user_id' => $clienteId,
            'dni' => '87654321',
            'telefono' => '999333444',
            'fecha_nacimiento' => '2000-08-15',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Direccion del cliente demo
        DB::table('addresses')->insert([
            'user_id' => $clienteId,
            'alias' => 'Casa',
            'calle' => 'Av. Los Pinos',
            'numero' => '345',
            'referencia' => 'Frente al parque, casa color crema',
            'distrito' => 'Surco',
            'provincia' => 'Lima',
            'departamento' => 'Lima',
            'codigo_postal' => '15023',
            'es_principal' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Carrito vacio para el cliente
        DB::table('carts')->insert([
            'user_id' => $clienteId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}