<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Paciente;
use App\EnfermedadBase;
use Validator;

class PacienteController extends ApiController
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $paciente= Paciente::join('zona','paciente.id_zona','=','zona.id')
            ->select('paciente.id','paciente.id_zona','paciente.nombre','paciente.sexo','paciente.ci','paciente.telefono','paciente.fecha_nacimiento',
            'paciente.localidad','paciente.direccion', 'paciente.estado','zona.nombre_prov', 'zona.nombre_mun')
            ->orderBy('paciente.id','desc')->paginate(10);
        }
        else{
            $paciente= Paciente::join('zona','paciente.id_zona','=','zona.id')
            ->select('paciente.id','paciente.id_zona','paciente.nombre','paciente.sexo','paciente.ci','paciente.telefono','paciente.fecha_nacimiento',
            'paciente.localidad','paciente.direccion', 'paciente.estado','zona.nombre_prov', 'zona.nombre_mun')
            ->where('paciente.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('paciente.id','desc')->paginate(10);            
        }
        return $this->sendResponse($paciente,"Ok");
    }

    public function store(Request $request)
    {        
        try{
            DB::beginTransaction();
            $validator=Validator::make($request->all(),[
                'id_zona'=>'required',
                'nombre'=>'required',
                'sexo'=>'required',
                'ci'=>'required',
                'fecha_nacimiento'=>'required',
                'localidad'=>'required',
                'estado'=>'required',
            ]);
            if($validator->fails()){
                return $this->sendError("Error de Validacion",422,$validator->errors());
            }
            $paciente= new Paciente();
            $input = $request->all();
            $paciente->fill($input)->save();  

            $detalles = $request->detalle;
            foreach($detalles as $ep=>$det){
                $detalle = new EnfermedadBase();
                $detalle->id_paciente=$paciente->id;
                $detalle->nombre_enf=$det['nombre_enf'];
                $detalle->observacion=$det['observacion'];
                $detalle->save();
            }
            DB::commit();
            return[
                'id'=>$paciente->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id_zona'=>'required',
            'nombre'=>'required',
            'sexo'=>'required',
            'ci'=>'required',
            'fecha_nacimiento'=>'required',
            'localidad'=>'required',
            'estado'=>'required',
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $paciente= Paciente::findOrFail($request->id);
        $input = $request->all();
        $paciente->fill($input)->save();
        return $this->sendResponse("Oky","OK");
    }

    public function deleteEnfermedad($id){
        $enfermedad = EnfermedadBase::where('enfermedad_base.id_paciente','=',$id);
        $enfermedad->delete();
    }

    public function delete($id){
        $this->deleteEnfermedad($id);       
        $paciente= Paciente::findOrFail($id);
        $paciente->delete();
    }

    public function selectEnfermedad(Request $request){
        $id=$request->id;
        $enfermedad= EnfermedadBase::where('enfermedad_base.id_paciente','=',$id)->get();      
        return $this->sendResponse($enfermedad,"Ok");
    }
}
