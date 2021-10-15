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
            'rut' => '200000001',
            'habilitado' => 1,
            'rol' => 'Administrador',
            'password' => bcrypt('123123'),

        ]);
        \App\Models\User::Create([
            'name' => 'Yo Soy Jefe',
            'email' => 'JefePrueba@ucn.cl',
            'rut' => '200000002',
            'habilitado' => 1,
            'rol' => 'Jefe de Carrera',
            'password' => bcrypt('123123'),
        ]);

        \App\Models\User::Create([
            'name' => 'Yo Soy Estudiante',
            'email' => 'EstudiantePrueba@ucn.cl',
            'rut' => '200000003',
            'habilitado' => 1,
            'rol' => 'Estudiante',
            'password' => bcrypt('123123'),
        ]);
    }
}
