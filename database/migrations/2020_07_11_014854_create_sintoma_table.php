<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSintomaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sintoma', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('nivel',40);
        });
        DB::table('sintoma')->insert(array('id'=>'1','nombre'=>'Fiebre','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'2','nombre'=>'Fiebre','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'3','nombre'=>'Fiebre','nivel'=>'severa'));
        DB::table('sintoma')->insert(array('id'=>'4','nombre'=>'Tos seca','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'5','nombre'=>'Tos seca','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'6','nombre'=>'Tos seca','nivel'=>'severa'));
        DB::table('sintoma')->insert(array('id'=>'7','nombre'=>'Cansancio','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'8','nombre'=>'Cansancio','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'9','nombre'=>'Cansancio','nivel'=>'severa'));
        DB::table('sintoma')->insert(array('id'=>'10','nombre'=>'Molestias y dolores','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'11','nombre'=>'Molestias y dolores','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'12','nombre'=>'Molestias y dolores','nivel'=>'severa'));        
        DB::table('sintoma')->insert(array('id'=>'13','nombre'=>'Dolor de garganta','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'14','nombre'=>'Dolor de garganta','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'15','nombre'=>'Dolor de garganta','nivel'=>'severa'));
        DB::table('sintoma')->insert(array('id'=>'16','nombre'=>'Dolor de cabeza','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'17','nombre'=>'Dolor de cabeza','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'18','nombre'=>'Dolor de cabeza','nivel'=>'severa'));
        DB::table('sintoma')->insert(array('id'=>'19','nombre'=>'Pérdida del sentido del olfato o del gusto','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'20','nombre'=>'Pérdida del sentido del olfato o del gusto','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'21','nombre'=>'Pérdida del sentido del olfato o del gusto','nivel'=>'severa'));
        DB::table('sintoma')->insert(array('id'=>'22','nombre'=>'Dificultad para respirar o sensación de falta de aire','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'23','nombre'=>'Dificultad para respirar o sensación de falta de aire','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'24','nombre'=>'Dificultad para respirar o sensación de falta de aire','nivel'=>'severa'));
        DB::table('sintoma')->insert(array('id'=>'25','nombre'=>'Dolor o presión en el pecho','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'26','nombre'=>'Dolor o presión en el pecho','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'27','nombre'=>'Dolor o presión en el pecho','nivel'=>'severa'));
        DB::table('sintoma')->insert(array('id'=>'28','nombre'=>'Incapacidad para hablar o moverse','nivel'=>'leve'));
        DB::table('sintoma')->insert(array('id'=>'29','nombre'=>'Incapacidad para hablar o moverse','nivel'=>'moderada'));
        DB::table('sintoma')->insert(array('id'=>'30','nombre'=>'Incapacidad para hablar o moverse','nivel'=>'severa'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sintoma');
    }
}
