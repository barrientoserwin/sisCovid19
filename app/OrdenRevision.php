<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenRevision extends Model
{
    protected $table = 'orden_revision';
    protected $fillable = [ 
        'id_paciente',
        'id_medico',
        'fecha_revision',
        'descripcion'
    ];
    public $timestamps = false;
}
