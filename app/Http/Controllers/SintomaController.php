<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sintoma;
use Validator;

class SintomaController extends ApiController
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');  
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){    
            $sintoma= Sintoma::select('sintoma.id','sintoma.nombre','sintoma.nivel')
            ->orderBy('sintoma.id','desc')->paginate(15);
        }
        else{
            $sintoma= Sintoma::select('sintoma.id','sintoma.nombre','sintoma.nivel')
            ->where('sintoma.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('sintoma.id','desc')->paginate(15);            
        }
        return $this->sendResponse($sintoma,"Ok");
    }

    public function store(Request $request)
    {    
        $validator=Validator::make($request->all(),[
            'nombre'=>'required',
            'nivel'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $sintoma= new Sintoma();
        $input = $request->all();
        $sintoma->fill($input)->save();
    }

    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'nombre'=>'required',
            'nivel'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError("Error de Validacion",422,$validator->errors());
        }
        $sintoma= Sintoma::findOrFail($request->id);
        $input = $request->all();
        $sintoma->fill($input)->save();
    }

    public function delete($id){      
        $sintoma= Sintoma::findOrFail($id);
        $sintoma->delete();
    }

    public function getDatos($id)
    {        
        $sintoma= Sintoma::findOrFail($id);
        return $this->sendResponse($sintoma,"OK");
    }

    public function selectSintoma(Request $request){
        if(!$request->ajax()) return redirect('/');
        $sintoma = Sintoma::select('nombre')
        ->distinct()->get(); 
        return $this->sendResponse($sintoma,"Ok");
    }

    public function selectSintomaId(Request $request){
        if(!$request->ajax()) return redirect('/');
        $nomb = $request->nombre;
        $niv = $request->nivel;
        $sintoma = Sintoma::select('sintoma.id')
        ->whereColumn([
            ['sintoma.nombre', '=', $nomb],
            ['sintoma.nivel', '=', $niv],
        ])->get();
        return $this->sendResponse($sintoma,"Ok");
    }
}
