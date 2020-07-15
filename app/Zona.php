<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = 'zona';
    protected $fillable = [ 
        'ciudad',
        'nombre_prov',
        'nombre_mun'
    ];
    public $timestamps = false;
    public function pacientes(){
        return $this->hasMany('App\Paciente');
    }
}
