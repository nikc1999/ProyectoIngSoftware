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
        //creacion de las carreras del listado mandado

        \App\Models\Carrera::Create([
            'nombre' => 'Arquitectura',
            'codigo' => '8039'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Derecho',
            'codigo' => '8043'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Geología',
            'codigo' => '8050'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Civil Ambiental',
            'codigo' => '8055'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Civil de Minas',
            'codigo' => '8074'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Civil en Computacion e Informatica',
            'codigo' => '8603'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Civil Industrial',
            'codigo' => '8092'
        ]);
         \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Civil Metalúrgica',
            'codigo' => '8132'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Civil Plan Común',
            'codigo' => '8141'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Civil Química',
            'codigo' => '8150'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Comercial',
            'codigo' => '8182'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria en Computacion e Informatica',
            'codigo' => '8184'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria en Informacion y Control de Gestión',
            'codigo' => '8189'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria en Metalurgia',
            'codigo' => '8221'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Ingenieria Tecnologías de Información',
            'codigo' => '8222'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Kinesiología',
            'codigo' => '8277'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Licenciatura en Física con mención en Astronomía',
            'codigo' => '8305'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Licenciatura en Matemática',
            'codigo' => '8349'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Medicina',
            'codigo' => '8421'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Nutrición y Dietetica',
            'codigo' => '8440'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Pedagogía en Educación Básica con Especialización',
            'codigo' => '8474'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Pedagogía en Inglés',
            'codigo' => '8481'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Pedagogía en Matemática en Educación Media',
            'codigo' => '8486'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Periodismo',
            'codigo' => '8570'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Psicología',
            'codigo' => '8594'
        ]);
        \App\Models\Carrera::Create([
            'nombre' => 'Quimica y Farmacia',
            'codigo' => '8659'
        ]);







        //el ya creado para las pruebas
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
            'rol' => 'Jefe de Carrera',
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
            'tipo' => 'Ayudantia',
            'telefono' => '98574827',

            'nombre_asignatura' => 'calculo 4',
            'detalles_estudiante' => 'quiero ser ayudante por',
            'calificacion_aprob' => '69',
            'cant_ayudantias' => 3,
        ]);


    }
}
