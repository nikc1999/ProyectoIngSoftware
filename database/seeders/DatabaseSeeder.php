<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::Create([
            'name' => 'Yo Soy Admin',
            'email' => 'AdminPrueba@ucn.cl',
            'rut' => '202119557',
            'habilitado' => 1,
            'rol' => 'Administrador',
            'password' => bcrypt('123123'),
        ]);
        \App\Models\User::Create([
            'name' => 'Miguel',
            'email' => 'miguek@ucn.cl',
            'rut' => '203482574',
            'habilitado' => 1,
            'rol' => 'Jefe de Carrera',
            'password' => bcrypt('123456'),
        ]);
    }
}
