<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();

            $table->string('telefono');
            $table->enum('estado',['Pendiente','Aceptada','Aceptada con observaciones','Anulada']);
            $table->enum('tipo',['Sobrecupo','Cambio paralelo','Eliminacion asignatura','Inscripcion asignatura','Ayudantia','Facilidades']);
            $table->string('detalles_jefe_carrera')->nullable();

            //columnas para sobrecupo, cambio paralelo, eliminación e inscripción asignatura.
            $table->string('NRC')->nullable();
            $table->string('nombre_asignatura')->nullable();
            $table->string('detalles_estudiante')->nullable();

            //columnas para solicitud ayudantía
            $table->string('calificacion_aprob')->nullable();
            $table->integer('cant_ayudantias')->nullable();

            //columnas facilidades academicas
            $table->enum('tipo_facilidad',['Licencia', 'Inasistencia Fuerza Mayor', 'Representacion', 'Inasistencia Motivo Personal'])->nullable();
            $table->string('nombre_profesor')->nullable();
            $table->json('archivos')->nullable();

            //relaciones
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicituds');
    }
}
