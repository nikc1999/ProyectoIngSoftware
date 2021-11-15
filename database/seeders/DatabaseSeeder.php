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

        \App\Models\Solicitud::Create([
            'user_id' => 2,
            'estado' => 'Pendiente',
            'tipo' => 'Sobrecupo',
            'telefono' => '98574827',
            'NRC' => '123456',
            'nombre_asignatura' => 'calculo 1',
            'detalles_estudiante' => 'le queria pedir el sobre cupo por'
        ]);

        \App\Models\Solicitud::Create([
            'user_id' => 2,
            'estado' => 'Pendiente',
            'tipo' => 'Cambio paralelo',
            'telefono' => '98574827',
            'NRC' => '123456',
            'nombre_asignatura' => 'calculo 2',
            'detalles_estudiante' => 'me queria cambiar de paralelo por'
        ]);

        \App\Models\Solicitud::Create([
            'user_id' => 2,
            'estado' => 'Pendiente',
            'tipo' => 'Eliminacion asignatura',
            'telefono' => '98574827',
            'NRC' => '123456',
            'nombre_asignatura' => 'calculo 3',
            'detalles_estudiante' => 'quiero botar esta asignatura por'
        ]);

        \App\Models\Solicitud::Create([
            'user_id' => 2,
            'estado' => 'Pendiente',
            'tipo' => 'Inscripcion asignatura',
            'telefono' => '98574827',
            'NRC' => '123456',
            'nombre_asignatura' => 'calculo 4',
            'detalles_estudiante' => 'quiero inscribir esta asignatura por'
        ]);

        \App\Models\Solicitud::Create([
            'user_id' => 2,
            'estado' => 'Pendiente',
            'tipo' => 'Inscripcion asignatura',
            'telefono' => '98574827',
            'NRC' => '123456',
            'nombre_asignatura' => 'calculo 4',
            'detalles_estudiante' => 'quiero inscribir esta asignatura por'
        ]);

        \App\Models\Solicitud::Create([
            'user_id' => 2,
            'estado' => 'Pendiente',
            'tipo' => 'Ayudantia',
            'telefono' => '98574827',

            'nombre_asignatura' => 'calculo 4',
            'detalles_estudiante' => 'quiero ser ayudante por',
            'calificacion_aprob' => '69',
            'cant_ayudantias' => 3,
        ]);


    }
}
