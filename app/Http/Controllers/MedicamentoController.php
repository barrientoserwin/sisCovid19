<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicamento;
use Validator;

class MedicamentoController extends ApiController
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');  
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){    
            $medicamento= Medicamento::select('medicamento.id','medicamento.descripcion','medicamento.tipo_medic')
            ->orderBy('medicamento.id','desc')->paginate(15);
        }
        else{
            $medicamento= Medicamento::select('medicamento.id','medicamento.descripcion','medicamento.tipo_medic')
            ->where('medicamento.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('medicamento.id','desc')->paginate(15);            
        }
        return $this->sendResponse($medicamento,"Ok");
    }

    public function store(Request $request)
    {        
        $validator=Validator::make($request->all(),[
            'descripcion'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $medicamento= new Medicamento();
        $input = $request->all();
        $medicamento->fill($input)->save();
    }

    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'descripcion'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $medicamento= Medicamento::findOrFail($request->id);
        $input = $request->all();
        $medicamento->fill($input)->save();
    }

    public function delete($id){      
        $medicamento= Medicamento::findOrFail($id);
        $medicamento->delete();
    }

    public function getDatos($id)
    {        
        $medicamento= Medicamento::findOrFail($id);
        return $this->sendResponse($medicamento,"OK");
    }

    public function selectMedicamento(Request $request){
        if(!$request->ajax()) return redirect('/');
        $medicamento = Medicamento::select('id', 'descripcion')->get(); 
        return $this->sendResponse($medicamento,"Ok");
    }
}
