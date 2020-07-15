<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdenRevision;
use Validator;

class OrdenRevisionController extends ApiController
{
    public function index(Request $request)
    {
         if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;        
        if ($buscar==''){
            $ordenRevision = OrdenRevision::join('paciente','orden_revision.id_paciente','=','paciente.id')
            ->join('medico','orden_revision.id_medico','=','medico.id')
            ->select('orden_revision.id','orden_revision.id_paciente','orden_revision.fecha_revision','orden_revision.descripcion',
            'paciente.nombre as paciente','paciente.localidad','paciente.estado','medico.nombre as medico')
            ->orderBy('orden_revision.id', 'desc')->paginate(10);
        }
        else{
            $ordenRevision = OrdenRevision::join('paciente','orden_revision.id_paciente','=','paciente.id')
            ->join('medico','orden_revision.id_medico','=','medico.id')
            ->select('orden_revision.id','orden_revision.id_paciente','orden_revision.fecha_revision','orden_revision.descripcion',
            'paciente.nombre as paciente','paciente.localidad','paciente.estado','medico.nombre as medico')         
            ->where('orden_revision.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('orden_revision.id', 'desc')->paginate(10);
        }
        return $this->sendResponse($ordenRevision,"Ok");
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id_paciente'=>'required',
            'id_medico'=>'required',
            'fecha_revision'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $ordenRevision = new OrdenRevision();
        $input = $request->all();
        $ordenRevision->fill($input)->save(); 
    }

    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id'=>'required',
            'id_paciente'=>'required',
            'id_medico'=>'required',
            'fecha_revision'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $ordenRevision= OrdenRevision::findOrFail($request->id);
        $input = $request->all();
        $ordenRevision->fill($input)->save(); 
    }
}
