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
    public function run() //esta funcion permite que al momento de runear el programa
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::Create([
            'name'=>'El Admin',
            'email' => 'admi@ucn.cl',
            'rut' => '203482574',
            'habilitado' => 1,
            'rol' => 'Administrador',
            'password' => bcrypt('123456'),
        ]);
    }
}
