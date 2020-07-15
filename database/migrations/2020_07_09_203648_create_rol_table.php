<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('descripcion', 80);
        });
        DB::table('rol')->insert(array('id'=>'1','nombre'=>'Administrador','descripcion'=>'Acceso Restringuido solo gerente, jefe, programador'));
        DB::table('rol')->insert(array('id'=>'2','nombre'=>'Medico','descripcion'=>'Acceso para trabajadores del hospital'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol');
    }
}
