<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medico';
    protected $fillable = [ 
        'id',
        'nombre',
        'ci',
        'telefono',
        'especialidad',
        'turno'
    ];
    public $timestamps = false;
}
