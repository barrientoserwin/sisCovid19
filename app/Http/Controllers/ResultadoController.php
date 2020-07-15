<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resultado;
use Validator;

class ResultadoController extends Controller
{
    public function index(Request $request)
    {
         if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;        
        if ($buscar==''){
            $resultado = Resultado::join('orden_revision','resultado.id_revision','=','orden_revision.id')
            ->join('persona','orden_revision.id_persona','=','persona.id')
            ->select('resultado.id','resultado.nombre_result','resultado.fecha_hr','resultado.resultado',
            'paciente.nombre as paciente','orden_revision.fecha_rev')
            ->orderBy('resultado.id', 'desc')->paginate(10);
        }
        else{
            $resultado = Resultado::join('orden_revision','resultado.id_revision','=','orden_revision.id')
            ->join('persona','orden_revision.id_persona','=','persona.id')
            ->select('resultado.id','resultado.nombre_result','resultado.fecha_hr','resultado.resultado',
            'paciente.nombre as paciente','orden_revision.fecha_rev')      
            ->where('resultado.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('orden_revision.id', 'desc')->paginate(10);
        }
        return $this->sendResponse($resultado,"Ok");
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id_revision'=>'required',
            'nombre_result'=>'required',
            'fecha_hr'=>'required',
            'resultado'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $resultado = new Resultado();
        $input = $request->all();
        $resultado->fill($input)->save(); 
    }

    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id'=>'required',
            'id_revision'=>'required',
            'nombre_result'=>'required',
            'fecha_hr'=>'required',
            'resultado'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $resultado= Resultado::findOrFail($request->id);
        $input = $request->all();
        $resultado->fill($input)->save(); 
    }
}
