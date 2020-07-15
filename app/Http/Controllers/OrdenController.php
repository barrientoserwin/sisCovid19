<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orden;
use Validator;

class OrdenController extends ApiController
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $orden= Orden::join('paciente','orden.id_paciente','=','paciente.id')
            ->join('hospital','orden.id_hospital','=','hospital.id')
            ->join('usuario','orden.id_usuario','=','usuario.id')
            ->select('orden.id','orden.fecha_ingreso','orden.fecha_salida','orden.tipo_orden','orden.tipo_salida',
            'hospital.nombre as hospital','paciente.nombre as paciente','usuario.nomb_usuario')
            ->orderBy('orden.id','desc')->paginate(10);
        }
        else{
            $orden= Orden::join('paciente','orden.id_paciente','=','paciente.id')
            ->join('hospital','orden.id_hospital','=','hospital.id')
            ->join('usuario','orden.id_usuario','=','usuario.id')
            ->select('orden.id','orden.fecha_ingreso','orden.fecha_salida','orden.tipo_orden','orden.tipo_salida',
            'hospital.nombre as hospital','paciente.nombre as paciente','usuario.nomb_usuario')
            ->where('orden.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('orden.id','desc')->paginate(10);            
        }
        return $this->sendResponse($orden,"Ok");
    }

    public function store(Request $request)
    {        
        $validator=Validator::make($request->all(),[
            'id_paciente'=>'required',
            'id_usuario'=>'required',
            'fecha_ingreso'=>'required',
            'tipo_orden'=>'required',
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $orden= new Orden();
        $input = $request->all();
        $orden->fill($input)->save();
    }

    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id_paciente'=>'required',
            'id_usuario'=>'required',
            'fecha_ingreso'=>'required',
            'tipo_orden'=>'required',
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $orden= Orden::findOrFail($request->id);
        $input = $request->all();
        $orden->fill($input)->save();
    }

    public function delete($id){      
        $orden= Orden::findOrFail($id);
        $orden->delete();
    }

    public function getDatos($id)
    {        
        $orden= Orden::findOrFail($id);
        return $this->sendResponse($orden,"OK");
    }
}
