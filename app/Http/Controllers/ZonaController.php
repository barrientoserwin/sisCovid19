<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zona;

class ZonaController extends ApiController
{
    public function index()
    {
        $zona= Zona::all();        
        return $this->sendResponse($zona,"Ok");
    }

    public function selectProvincia(){
        $zona= Zona::select('zona.nombre_prov')->distinct()->get();        
        return $this->sendResponse($zona,"Ok");
    }

    public function selectMunicipio(){
        $zona= Zona::select('zona.id','zona.nombre_mun')->get();        
        return $this->sendResponse($zona,"Ok");
    }

    public function selectZona(Request $request){
        if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $zona = Zona::where('zona.nombre_mun', 'like', '%'.$filtro.'%')
        ->select('zona.id','zona.nombre_mun','zona.nombre_prov')
        ->orderBy('zona.nombre_mun', 'asc')->get();
        return $this->sendResponse($zona,"Ok");
    }
}
