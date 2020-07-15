<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenRevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_revision', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente');
            $table->foreignId('id_medico');
            $table->date('fecha_revision');
            $table->string('descripcion',80)->nullable();
            $table->foreign('id_paciente')->references('id')->on('paciente');
            $table->foreign('id_medico')->references('id')->on('medico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_revision');
    }
}
