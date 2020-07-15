<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleSintoma extends Model
{
    protected $table = 'detalle_sintoma';
    protected $fillable = [ 
        'id_seguimiento',
        'id_sintoma',
        'fecha_sint'
    ];
    public $timestamps = false;
}
