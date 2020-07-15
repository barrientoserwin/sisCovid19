<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $table = 'sintoma';
    protected $fillable = [ 
        'nombre',
        'nivel'
    ];
    public $timestamps = false;
}
