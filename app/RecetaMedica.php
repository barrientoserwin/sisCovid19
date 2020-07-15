<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecetaMedica extends Model
{
    protected $table = 'receta_medica';
    protected $fillable = [ 
        'id_seguimiento',
        'id_receta',
        'fecha_recet',
        'indicacion',
        'observacion',
        'id_medicamento'
    ];
    public $timestamps = false;
}
