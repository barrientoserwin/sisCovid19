<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnfermedadBase extends Model
{
    protected $table = 'enfermedad_base';
    protected $fillable = [ 
        'id_paciente',
        'nombre_enf',
        'observacion'
    ];
    public $timestamps = false;
}
