<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('telefono',40);
            $table->string('localidad',40)->nullable();
            $table->string('direccion',80);
        });
        DB::table('hospital')->insert(array('id'=>'1','nombre'=>'Hospital Municipal Alfonso Gumucio Reyes','telefono'=>'3 9220111','localidad'=>'Montero/Obispo Santiestevan','direccion'=>'entre c. Avaroa y c. Jose Cuellar'));
        DB::table('hospital')->insert(array('id'=>'2','nombre'=>'Hospital Juana Azurduy','telefono'=>'3 9220581','localidad'=>'Montero/Obispo Santiestevan','direccion'=>'barrio 3 de mayo'));
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospital');
    }
}
