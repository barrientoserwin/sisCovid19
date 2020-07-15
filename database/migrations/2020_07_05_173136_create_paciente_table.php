<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_zona');
            $table->string('nombre',60);
            $table->char('sexo',1);
            $table->string('ci',10);
            $table->string('telefono',40)->nullable();
            $table->date('fecha_nacimiento');
            $table->string('localidad',40);
            $table->string('direccion',80)->nullable();
            $table->string('estado',20);
            $table->foreign('id_zona')->references('id')->on('zona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paciente');
    }
}
