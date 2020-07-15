<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hospital;
use Validator;

class HospitalController extends ApiController
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $hospital= Hospital::select('hospital.id','hospital.nombre','hospital.telefono','hospital.localidad','hospital.direccion')
            ->orderBy('hospital.id','desc')->paginate(10);
        }
        else{
            $hospital= Hospital::select('hospital.id','hospital.nombre','hospital.telefono','hospital.localidad','hospital.direccion')
            ->where('hospital.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('hospital.id','desc')->paginate(10);            
        }
        return $this->sendResponse($hospital,"Ok");
    }

    public function store(Request $request)
    {      
        $validator=Validator::make($request->all(),[
            'nombre'=>'required',
            'telefono'=>'required',
            'localidad'=>'required',
            'direccion'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $hospital= new Hospital();
        $input = $request->all();
        $hospital->fill($input)->save();
    }

    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id'=>'required',
            'nombre'=>'required',
            'telefono'=>'required',
            'localidad'=>'required',
            'direccion'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $hospital= Hospital::findOrFail($request->id);
        $input = $request->all();
        $hospital->fill($input)->save();
    }

    public function delete($id){   
        $hospital= Hospital::findOrFail($id);
        $hospital->delete();
    }

    public function getDatos($id)
    {        
        $hospital= Hospital::findOrFail($id);
        return $this->sendResponse($hospital,"OK");
    }
}
