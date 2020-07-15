<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSintomaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_sintoma', function (Blueprint $table) {
            $table->foreignId('id_seguimiento');
            $table->foreignId('id_sintoma');
            $table->dateTime('fecha_sint');
            $table->primary(['id_seguimiento', 'id_sintoma']);
            $table->foreign('id_seguimiento')->references('id')->on('seguimiento');
            $table->foreign('id_sintoma')->references('id')->on('sintoma');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_sintoma');
    }
}
