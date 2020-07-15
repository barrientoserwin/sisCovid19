<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $table = 'resultado';
    protected $fillable = [ 
        'id_revision',
        'nombre_result',
        'fecha_hr',
        'resultado'
    ];
    public $timestamps = false;
}
