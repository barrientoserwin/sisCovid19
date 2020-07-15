<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class RolController extends ApiController
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');  
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){    
            $rol= Rol::select('rol.id','rol.nombre','rol.descripcion')
            ->orderBy('rol.id','desc')->paginate(5);
        }
        else{
            $rol= Rol::select('rol.id','rol.nombre','rol.descripcion')
            ->where('rol.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('rol.id','desc')->paginate(5);            
        }
        return $this->sendResponse($rol,"Ok");
    }

    public function selectRol(Request $request){
        if(!$request->ajax()) return redirect('/');
        $rol = Rol::select('id', 'nombre')
        ->orderBy('nombre', 'asc')->get(); 
        return $this->sendResponse($rol,"Ok");
    }
}
