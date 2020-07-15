<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
    public $timestamps = false;
    public function users(){
        return $this->hasMany('App\User');
    }
}
