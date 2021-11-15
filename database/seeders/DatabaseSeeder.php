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
            'rut' => '203482574',
            'habilitado' => 1,
            'rol' => 'Administrador',
            'password' => bcrypt('123123'),

        ]);

        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Civil Industrial',
            'codigo' => '4526'
        ]);

        \App\Models\User::Create([
            'name' => 'Yo Soy Estudiante',
            'email' => 'Estudiante@ucn.cl',
            'rut' => '201078164',
            'habilitado' => 1,
            'rol' => 'Estudiante',
            'password' => bcrypt('123123'),
            'carrera_id' => 1,

        ]);

        \App\Models\User::Create([
            'name' => 'Yo Soy Jefe Carrera',
            'email' => 'JefeCarrera@ucn.cl',
            'rut' => '202119557',
            'habilitado' => 1,
            'rol' => 'Estudiante',
            'password' => bcrypt('123123'),
            'carrera_id' => 1,

        ]);



    }
}
