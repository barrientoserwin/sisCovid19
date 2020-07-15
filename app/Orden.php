<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orden';
    protected $fillable = [ 
        'id_paciente',
        'id_usuario',
        'id_hospital',
        'fecha_ingreso',
        'fecha_salida',
        'tipo_orden',
        'tipo_salida'
    ];
    public $timestamps = false;
    public function seguimientos(){
        return $this->hasMany('App\Seguimiento');
    }
}
