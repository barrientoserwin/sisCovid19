<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seguimiento;
use Validator;

class SeguimientoController extends ApiController
{
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        if($buscar==''){
            $seguimiento= Seguimiento::join('orden','seguimiento.id_orden','=','orden.id')
            ->join('medico','seguimiento.id_medico','=','medico.id')
            ->join('paciente','orden.id_paciente','=','paciente.id')
            ->join('hospital','orden.id_hospital','=','hospital.id')
            ->select('seguimiento.id','seguimiento.id_orden','seguimiento.fase','seguimiento.observacion',
            'medico.nombre as medico','hospital.nombre as hospital','paciente.nombre as paciente')
            ->orderBy('seguimiento.id_orden','desc')->paginate(10);
        }
        else{
            $seguimiento= Seguimiento::join('orden','seguimiento.id_orden','=','orden.id')
            ->join('medico','seguimiento.id_medico','=','medico.id')
            ->join('paciente','orden.id_paciente','=','paciente.id')
            ->join('hospital','orden.id_hospital','=','hospital.id')
            ->select('seguimiento.id','seguimiento.id_orden','seguimiento.fase','seguimiento.observacion',
            'medico.nombre as medico','hospital.nombre as hospital','paciente.nombre as paciente')
            ->where('seguimiento.fase', 'like', '%'.$buscar.'%')
            ->orWhere('paciente.nombre', 'like', '%'.$buscar.'%')
            ->orWhere('medico.nombre', 'like', '%'.$buscar.'%')
            ->orderBy('seguimiento.id_orden','desc')->paginate(10);            
        }
        
        return $this->sendResponse($seguimiento,"Ok");
    }

    public function store(Request $request)
    {    
        $validator=Validator::make($request->all(),[
            'id_orden'=>'required',
            'id_medico'=>'required',
            'fase'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $seguimiento= new Seguimiento();
        $input = $request->all();
        $seguimiento->fill($input)->save();
    }
}
