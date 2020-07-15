<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamento', function (Blueprint $table) {
            $table->id();            
            $table->string('descripcion',100)->nullable();
            $table->string('tipo_medic',70)->nullable();
        });
        DB::table('medicamento')->insert(array('id'=>'1','descripcion'=>'Anakinra 100 mg inyectable 0,67 ml jeringa precargada.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'2','descripcion'=>'Azitromicina 500 mg inyectable perfusión.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'3','descripcion'=>'Azitromicina 1.000 mg solución/suspensión oral sobre.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'4','descripcion'=>'Azitromicina 150 mg solución/suspensión oral sobre.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'5','descripcion'=>'Azitromicina 200 mg/5 ml solución/suspensión oral.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'6','descripcion'=>'Azitromicina 250 mg cápsula.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'7','descripcion'=>'Azitromicina 250 mg comprimido.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'8','descripcion'=>'Azitromicina 250 mg solución/suspensión oral sobre.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'9','descripcion'=>'Azitromicina 500 mg comprimido','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'10','descripcion'=>'Azitromicina 500 mg inyectable perfusión.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'11','descripcion'=>'Azitromicina 500 mg solución/suspensión oral sobre.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'12','descripcion'=>'Azitromicina 1.000 mg solución/suspensión oral sobre.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'13','descripcion'=>'Bromuro ipratropio 0,3 mg/ml producto uso nasal.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'14','descripcion'=>'Bromuro ipratropio 20 microgramos/dosis inhalación pulmonar.','tipo_medic'=>''));        
        DB::table('medicamento')->insert(array('id'=>'15','descripcion'=>'Bromuro ipratropio 250 microgramos inhalación pulmonar 1 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'16','descripcion'=>'Bromuro ipratropio 250 microgramos inhalación pulmonar 2 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'17','descripcion'=>'Bromuro ipratropio 500 microgramos inhalación pulmonar 2 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'18','descripcion'=>'Cefditoreno 200 mg comprimido.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'19','descripcion'=>'Cefditoreno 400 mg comprimido.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'20','descripcion'=>'Ciclosporina 1 mg/ml colirio.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'21','descripcion'=>'Ciclosporina 25 mg cápsula.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'22','descripcion'=>'Ciclosporina 50 mg cápsula.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'23','descripcion'=>'Ciclosporina 50 mg/ml solución perfusión.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'24','descripcion'=>'Ciclosporina 100 mg cápsula.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'25','descripcion'=>'Cisatracurio besilato 2 mg/ml inyectable 10 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'26','descripcion'=>'Cisatracurio besilato 2 mg/ml inyectable 2,5 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'27','descripcion'=>'Cisatracurio besilato 2 mg/ml inyectable 5 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'28','descripcion'=>'Cisatracurio besilato 5 mg/ml inyectable 30 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'29','descripcion'=>'Clonazepam 1 mg inyectable 1 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'30','descripcion'=>'Dexametasona 1 mg comprimidos','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'31','descripcion'=>'Dexametasona 4 mg comprimidos.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'32','descripcion'=>'Dexametasona 8 mg comprimidos.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'33','descripcion'=>'Dexametasona 4mg inyectable 1 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'34','descripcion'=>'Dexametasona 40mg inyectable 5 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'35','descripcion'=>'Dexmedetomidina 100 microgramos/ml inyectable perfusión 10 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'36','descripcion'=>'Dexmedetomidina 100 microgramos/ml inyectable perfusión 2 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'37','descripcion'=>'Dexmedetomidina 100 microgramos/ml inyectable perfusión 4 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'38','descripcion'=>'Diazepam 5 mg líquido rectal.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'39','descripcion'=>'Diazepam 10 mg líquido rectal.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'40','descripcion'=>'Dobutamina 250 mg inyectable perfusión 20 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'41','descripcion'=>'Dopamina 200 mg inyectable 5 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'42','descripcion'=>'Enoxaparina sodio 40 mg (4.000 UI) inyectable 0,4 ml jeringa precargada.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'43','descripcion'=>'Enoxaparina sodio 40 mg (4.000 UI) inyectable 0,4 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'44','descripcion'=>'Fentanilo 50 microgramos/ml inyectable 3 ml.','tipo_medic'=>'Medicamento para analgesia'));
        DB::table('medicamento')->insert(array('id'=>'45','descripcion'=>'Haloperidol 5 mg inyectable 1 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'46','descripcion'=>'Levomepromazina 25 mg inyectable 1 ml.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'47','descripcion'=>'Metilprednisolona 1.000 mg inyectable.','tipo_medic'=>''));
        DB::table('medicamento')->insert(array('id'=>'48','descripcion'=>'Paracetamol, Inyección: ampolla de 10 mg/ml en 10 ml o vial 50-100 ml ','tipo_medic'=>'Medicamento para la fiebre'));
        DB::table('medicamento')->insert(array('id'=>'49','descripcion'=>'Morfina, Inyección: ampolla de 10 mg (sulfato o clorhidrato) en 1 ml','tipo_medic'=>'Medicamento para analgesia'));
        DB::table('medicamento')->insert(array('id'=>'50','descripcion'=>'Propofol 5 mg/ml inyectable 20 ml.','tipo_medic'=>'Medicamento para sedacion'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicamento');
    }
}
