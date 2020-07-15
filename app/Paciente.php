<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'paciente';
    protected $fillable = [ 
        'id_zona',
        'nombre',
        'sexo',
        'ci',
        'telefono',
        'fecha_nacimiento',
        'localidad',
        'direccion',
        'estado'
    ];
    public $timestamps = false;
    public function zona(){
        return $this->belongsTo('App\Zona');
    }
}
