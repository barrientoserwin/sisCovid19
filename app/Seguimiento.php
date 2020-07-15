<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimiento';
    protected $fillable = [ 
        'id_orden',
        'id_medico',
        'fase',
        'observacion'
    ];
    public $timestamps = false;
    public function orden(){
        return $this->belongsTo('App\Orden');
    }
}
