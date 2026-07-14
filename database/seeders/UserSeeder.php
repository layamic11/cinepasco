<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos al GERENTE (Administrador)
        User::create([
            'name' => 'Gerente CinePasco',
            'email' => 'admin@cinepasco.com',
            'password' => Hash::make('admin123'), // Contraseña encriptada por seguridad
            'rol' => 'admin'
        ]);

        // (Opcional) Creamos un cliente de prueba para hacer simulaciones
        User::create([
            'name' => 'Obed Espiritu',
            'email' => 'obed@gmail.com',
            'password' => Hash::make('obed123'),
            'rol' => 'cliente'
        ]);
    }
}