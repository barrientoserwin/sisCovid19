<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rol');
            $table->string('nomb_usuario',20)->unique();
            $table->string('password',64);
            $table->string('estado',20);
            $table->foreign('id_rol')->references('id')->on('rol');
        });
        DB::table('usuario')->insert(array('id'=>'1',
        'id_rol'=>'1',
        'nomb_usuario'=>'barrientos',
        'password'=>'$2y$10$sPmrxcxDSg3tU1vyOmWpXOV.lzv59kLUVQIGC2i49lIcOTSKabJeO',
        'estado'=>'activo'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
