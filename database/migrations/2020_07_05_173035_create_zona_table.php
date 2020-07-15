<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zona', function (Blueprint $table) {
            $table->id();
            $table->string('ciudad',50);
            $table->string('nombre_prov',50);
            $table->string('nombre_mun',50);
        });
        DB::table('zona')->insert(array('id'=>'1','ciudad'=>'Santa Cruz','nombre_prov'=>'Andrés Ibáñez','nombre_mun'=>'Santa Cruz de la Sierra'));
        DB::table('zona')->insert(array('id'=>'2','ciudad'=>'Santa Cruz','nombre_prov'=>'Andrés Ibáñez','nombre_mun'=>'Cotoca'));
        DB::table('zona')->insert(array('id'=>'3','ciudad'=>'Santa Cruz','nombre_prov'=>'Andrés Ibáñez','nombre_mun'=>'El Torno'));
        DB::table('zona')->insert(array('id'=>'4','ciudad'=>'Santa Cruz','nombre_prov'=>'Andrés Ibáñez','nombre_mun'=>'La Guardia'));
        DB::table('zona')->insert(array('id'=>'5','ciudad'=>'Santa Cruz','nombre_prov'=>'Andrés Ibáñez','nombre_mun'=>'Porongo'));

        DB::table('zona')->insert(array('id'=>'6','ciudad'=>'Santa Cruz','nombre_prov'=>'Obispo Santiestevan','nombre_mun'=>'Montero'));
        DB::table('zona')->insert(array('id'=>'7','ciudad'=>'Santa Cruz','nombre_prov'=>'Obispo Santiestevan','nombre_mun'=>'Gral. Saavedra'));
        DB::table('zona')->insert(array('id'=>'8','ciudad'=>'Santa Cruz','nombre_prov'=>'Obispo Santiestevan','nombre_mun'=>'Minero'));
        DB::table('zona')->insert(array('id'=>'9','ciudad'=>'Santa Cruz','nombre_prov'=>'Obispo Santiestevan','nombre_mun'=>'Fernández Alonso'));
        DB::table('zona')->insert(array('id'=>'10','ciudad'=>'Santa Cruz','nombre_prov'=>'Obispo Santiestevan','nombre_mun'=>'San Pedro'));

        DB::table('zona')->insert(array('id'=>'11','ciudad'=>'Santa Cruz','nombre_prov'=>'Ñuflo de Chávez','nombre_mun'=>'Concepción'));
        DB::table('zona')->insert(array('id'=>'12','ciudad'=>'Santa Cruz','nombre_prov'=>'Ñuflo de Chávez','nombre_mun'=>'Cuatro Cañadas'));
        DB::table('zona')->insert(array('id'=>'13','ciudad'=>'Santa Cruz','nombre_prov'=>'Ñuflo de Chávez','nombre_mun'=>'San Antonio de Lomerío'));
        DB::table('zona')->insert(array('id'=>'14','ciudad'=>'Santa Cruz','nombre_prov'=>'Ñuflo de Chávez','nombre_mun'=>'San Julian'));
        DB::table('zona')->insert(array('id'=>'15','ciudad'=>'Santa Cruz','nombre_prov'=>'Ñuflo de Chávez','nombre_mun'=>'San Ramón'));
        DB::table('zona')->insert(array('id'=>'16','ciudad'=>'Santa Cruz','nombre_prov'=>'Ñuflo de Chávez','nombre_mun'=>'San Xavier'));

        DB::table('zona')->insert(array('id'=>'17','ciudad'=>'Santa Cruz','nombre_prov'=>'Cordillera','nombre_mun'=>'Lagunillas'));
        DB::table('zona')->insert(array('id'=>'18','ciudad'=>'Santa Cruz','nombre_prov'=>'Cordillera','nombre_mun'=>'Boyuibe'));
        DB::table('zona')->insert(array('id'=>'19','ciudad'=>'Santa Cruz','nombre_prov'=>'Cordillera','nombre_mun'=>'Cabezas'));
        DB::table('zona')->insert(array('id'=>'20','ciudad'=>'Santa Cruz','nombre_prov'=>'Cordillera','nombre_mun'=>'Camiri'));
        DB::table('zona')->insert(array('id'=>'21','ciudad'=>'Santa Cruz','nombre_prov'=>'Cordillera','nombre_mun'=>'Charagua'));
        DB::table('zona')->insert(array('id'=>'22','ciudad'=>'Santa Cruz','nombre_prov'=>'Cordillera','nombre_mun'=>'Cuevo'));
        DB::table('zona')->insert(array('id'=>'23','ciudad'=>'Santa Cruz','nombre_prov'=>'Cordillera','nombre_mun'=>'Gutiérrez'));

        DB::table('zona')->insert(array('id'=>'24','ciudad'=>'Santa Cruz','nombre_prov'=>'Ichilo','nombre_mun'=>'Buena Vista'));
        DB::table('zona')->insert(array('id'=>'25','ciudad'=>'Santa Cruz','nombre_prov'=>'Ichilo','nombre_mun'=>'San Carlos'));
        DB::table('zona')->insert(array('id'=>'26','ciudad'=>'Santa Cruz','nombre_prov'=>'Ichilo','nombre_mun'=>'San Juan de Yapacaní'));
        DB::table('zona')->insert(array('id'=>'27','ciudad'=>'Santa Cruz','nombre_prov'=>'Ichilo','nombre_mun'=>'Yapacaní'));

        DB::table('zona')->insert(array('id'=>'28','ciudad'=>'Santa Cruz','nombre_prov'=>'Chiquitos','nombre_mun'=>'San José de Chiquitos'));
        DB::table('zona')->insert(array('id'=>'29','ciudad'=>'Santa Cruz','nombre_prov'=>'Chiquitos','nombre_mun'=>'Pailón'));
        DB::table('zona')->insert(array('id'=>'30','ciudad'=>'Santa Cruz','nombre_prov'=>'Chiquitos','nombre_mun'=>'Roboré'));

        DB::table('zona')->insert(array('id'=>'31','ciudad'=>'Santa Cruz','nombre_prov'=>'José Miguel de Velasco','nombre_mun'=>'San Ignacio de Velasco'));
        DB::table('zona')->insert(array('id'=>'32','ciudad'=>'Santa Cruz','nombre_prov'=>'José Miguel de Velasco','nombre_mun'=>'San Miguel de Velasco'));
        DB::table('zona')->insert(array('id'=>'33','ciudad'=>'Santa Cruz','nombre_prov'=>'José Miguel de Velasco','nombre_mun'=>'San Rafael de Velasco'));

        DB::table('zona')->insert(array('id'=>'34','ciudad'=>'Santa Cruz','nombre_prov'=>'Warnes','nombre_mun'=>'Warnes'));
        DB::table('zona')->insert(array('id'=>'35','ciudad'=>'Santa Cruz','nombre_prov'=>'Warnes','nombre_mun'=>'Okinawa 1'));

        DB::table('zona')->insert(array('id'=>'36','ciudad'=>'Santa Cruz','nombre_prov'=>'Sara','nombre_mun'=>'Portachuelo'));
        DB::table('zona')->insert(array('id'=>'37','ciudad'=>'Santa Cruz','nombre_prov'=>'Sara','nombre_mun'=>'Colpa Bélgica'));
        DB::table('zona')->insert(array('id'=>'38','ciudad'=>'Santa Cruz','nombre_prov'=>'Sara','nombre_mun'=>'Santa Rosa del Sara'));

        DB::table('zona')->insert(array('id'=>'39','ciudad'=>'Santa Cruz','nombre_prov'=>'Guarayos','nombre_mun'=>'Ascención de Guarayos'));
        DB::table('zona')->insert(array('id'=>'40','ciudad'=>'Santa Cruz','nombre_prov'=>'Guarayos','nombre_mun'=>'El Puente'));
        DB::table('zona')->insert(array('id'=>'41','ciudad'=>'Santa Cruz','nombre_prov'=>'Guarayos','nombre_mun'=>'Urubichá'));

        DB::table('zona')->insert(array('id'=>'42','ciudad'=>'Santa Cruz','nombre_prov'=>'Germán Busch','nombre_mun'=>'Puerto Suárez'));
        DB::table('zona')->insert(array('id'=>'43','ciudad'=>'Santa Cruz','nombre_prov'=>'Germán Busch','nombre_mun'=>'Carmen Rivero'));
        DB::table('zona')->insert(array('id'=>'44','ciudad'=>'Santa Cruz','nombre_prov'=>'Germán Busch','nombre_mun'=>'Puerto Quijarro'));

        DB::table('zona')->insert(array('id'=>'45','ciudad'=>'Santa Cruz','nombre_prov'=>'Florida','nombre_mun'=>'Samaipata'));
        DB::table('zona')->insert(array('id'=>'46','ciudad'=>'Santa Cruz','nombre_prov'=>'Florida','nombre_mun'=>'Mairana'));
        DB::table('zona')->insert(array('id'=>'47','ciudad'=>'Santa Cruz','nombre_prov'=>'Florida','nombre_mun'=>'Pampagrande'));
        DB::table('zona')->insert(array('id'=>'48','ciudad'=>'Santa Cruz','nombre_prov'=>'Florida','nombre_mun'=>'Quirusillas'));

        DB::table('zona')->insert(array('id'=>'49','ciudad'=>'Santa Cruz','nombre_prov'=>'Vallegrande','nombre_mun'=>'Vallegrande'));
        DB::table('zona')->insert(array('id'=>'50','ciudad'=>'Santa Cruz','nombre_prov'=>'Vallegrande','nombre_mun'=>'El Trigal'));
        DB::table('zona')->insert(array('id'=>'51','ciudad'=>'Santa Cruz','nombre_prov'=>'Vallegrande','nombre_mun'=>'Moro Moro'));
        DB::table('zona')->insert(array('id'=>'52','ciudad'=>'Santa Cruz','nombre_prov'=>'Vallegrande','nombre_mun'=>'Postrervalle'));
        DB::table('zona')->insert(array('id'=>'53','ciudad'=>'Santa Cruz','nombre_prov'=>'Vallegrande','nombre_mun'=>'Pucará'));    

        DB::table('zona')->insert(array('id'=>'54','ciudad'=>'Santa Cruz','nombre_prov'=>'Manuel María Caballero','nombre_mun'=>'Comarapa'));
        DB::table('zona')->insert(array('id'=>'55','ciudad'=>'Santa Cruz','nombre_prov'=>'Manuel María Caballero','nombre_mun'=>'Saipina'));

        DB::table('zona')->insert(array('id'=>'56','ciudad'=>'Santa Cruz','nombre_prov'=>'Ángel Sandoval','nombre_mun'=>'San Matías'));
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zona');
    }
}
