<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caso_id')->constrained();
            $table->foreignId('asignado_a')->constrained('users');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->enum('prioridad', ['baja', 'media', 'alta']);
            $table->enum('estado', ['pendiente', 'en progreso', 'completado'])->default('pendiente');
            $table->date('fecha_limite')->nullable();
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
        Schema::dropIfExists('tareas');
    }
}
