<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetaMedicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receta_medica', function (Blueprint $table) {
            $table->foreignId('id_seguimiento');
            $table->bigInteger('id_receta');
            $table->dateTime('fecha_recet');
            $table->string('indicacion',100)->nullable();
            $table->string('observacion',80)->nullable();
            $table->foreignId('id_medicamento');
            $table->primary(['id_seguimiento', 'id_receta']);
            $table->foreign('id_seguimiento')->references('id')->on('seguimiento');
            $table->foreign('id_medicamento')->references('id')->on('medicamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receta_medica');
    }
}
