<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $table = 'medicamento';
    protected $fillable = [ 
        'descripcion',
        'tipo_medic'
    ];
    public $timestamps = false;
}
