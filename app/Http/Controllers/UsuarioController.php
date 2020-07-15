<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Medico;
use Validator;

class UsuarioController extends ApiController
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;        
        if ($buscar==''){
            $medico = User::join('medico','usuario.id','=','medico.id')
            ->join('rol','usuario.id_rol','=','rol.id')
            ->select('medico.id','medico.nombre','medico.ci','medico.telefono','medico.especialidad','medico.turno',
            'usuario.id_rol','usuario.nomb_usuario','usuario.password','usuario.estado','rol.nombre as rol')
            ->orderBy('medico.id', 'desc')->paginate(10);
        }
        else{
            $medico = User::join('medico','usuario.id','=','medico.id')
            ->join('rol','usuario.id_rol','=','rol.id')
            ->select('medico.id','medico.nombre','medico.ci','medico.telefono','medico.especialidad','medico.turno',
            'usuario.id_rol','usuario.nomb_usuario','usuario.password','usuario.estado','rol.nombre as rol')          
            ->where('medico.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('medico.id', 'desc')->paginate(5);
        }        
        return $this->sendResponse($medico,"Ok");
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $validator=Validator::make($request->all(),[
                'id_rol'=>'required',
                'nomb_usuario'=>'required',
                'password'=>'required',
                'nombre'=>'required',
                'ci'=>'required',
                'turno'=>'required',
            ]);
            if($validator->fails()){
                return $this->sendError("Error de Validacion",422,$validator->errors());
            }
            $usuario = new User();
            $usuario->id_rol=$request->get('id_rol');
            $usuario->nomb_usuario=$request->get('nomb_usuario');
            $usuario->password=bcrypt($request->get('password'));
            $usuario->estado='activo'; 
            $usuario->save();                     
            

            $medico= new Medico();
            $medico->id=$usuario->id;
            $medico->nombre=$request->get('nombre');
            $medico->ci=$request->get('ci');
            $medico->telefono=$request->get('telefono');
            $medico->especialidad=$request->get('especialidad');
            $medico->turno=$request->get('turno');
            $medico->save(); 
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
        
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $validator=Validator::make($request->all(),[
                'id'=>'required',
                'id_rol'=>'required',
                'nomb_usuario'=>'required',
                'password'=>'required',
                'nombre'=>'required',
                'ci'=>'required',
                'turno'=>'required',
            ]);
            if($validator->fails()){
                return $this->sendError("Error de Validacion",422,$validator->errors());
            }
            $medico= Medico::findOrFail($request->id);
            $usuario= User::findOrFail($medico->id);
            
            $usuario->id_rol=$request->get('id_rol');
            $usuario->nomb_usuario=$request->get('nomb_usuario');
            $usuario->password=bcrypt($request->get('password'));
            $usuario->estado='activo'; 
            $usuario->save(); 

            $medico->nombre=$request->get('nombre');
            $medico->ci=$request->get('ci');
            $medico->telefono=$request->get('telefono');
            $medico->especialidad=$request->get('especialidad');
            $medico->turno=$request->get('turno');
            $medico->save();          
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuario = User::findOrFail($request->id);
        $usuario->estado = 'desactivo';
        $usuario->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuario = User::findOrFail($request->id);
        $usuario->estado = 'activo';
        $usuario->save();
    }
}
