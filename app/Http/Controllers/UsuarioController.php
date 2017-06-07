<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Usuario as usuario;

class UsuarioController extends Controller
{
    function __construct(){}

    public function list() {
        $usuarios = usuario::all();            
        if(!$usuarios->isEmpty()){
            return response()->json($usuarios, 200);
        }else{
            return response()->json(['error'=> 'Usuarios não encontrados'], 404);
        }
        
    }

    public function read($id){
        $usuario = usuario::find($id);
        if($usuario){
            return response()->json($usuario, 200);
        }else{
            return response()->json(['error'=> 'Usuario não encontrado'], 404);
        }
    }

    public function create(Request $request) {
        $usuario = new Usuario;
             
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|unique:usuarios',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=> 'Email ja cadastrado!'], 500);
        }

        $input = $request->all();
        @$usuario->name = @$input['name'];
        @$usuario->tel = @$input['tel'];
        @$usuario->cpf = @$input['cpf'];
        @$usuario->password = @$input['password'];
        @$usuario->email = @$input['email'];
        $usuario->save();
        return response()->json(['success'=> 'Usuario Cadsatrado com sucesso'], 200);
        
    }

    public function update(Request $request,$id){
        
        $usuario=usuario::find($id);
        $input = $request->all();
       
        if($usuario){
            $usuario->name = @$input['name'];
            $usuario->tel = @$input['tel'];
            $usuario->cpf = @$input['cpf'];
            #$usuario->password = @$input['password'];
            $usuario->email = @$input['email'];
            $usuario->save();
            return response()->json($usuario, 200);
        }else{
            return response()->json(['error'=> 'Usuario não encontrado'], 404);
        }
    }
    public function updatepass(Request $request,$id){
        
        $usuario=usuario::find($id);
        $input = $request->all();
       
        if($usuario){
            $usuario->password = @$input['password'];
            $usuario->save();
            return response()->json($usuario, 200);
        }else{
            return response()->json(['error'=> 'Usuario não encontrado'], 404);
        }
    }
  
    public function delete($id){
        $usuario = usuario::find($id);
        if($usuario){
            if($usuario->delete()){
                return response()->json(['message'=> 'Usuario deletado'], 200);
            }else{
                return response()->json(['error'=> 'Erro ao Deletar Usuario'], 500);
            }
        }else{
            return response()->json(['error'=> 'Usuario não encontrado'], 404);   
        }
    }
    public function login(Request $request){
        $usuarios = usuario::all();
        $input = $request->all();
        if(!$usuarios->isEmpty()){
            foreach($usuarios as $usuario){
                if(($input['email']===$usuario->email)&&($input['password']===$usuario->password)){
                    return response()->json([
                        'logado' => 1,
                        'usuario_id' => $usuario->id,
                        'usuario_email' =>$usuario->email,
                        'type' => 'usuario'
                    ]);
                }
            }
        }else{
            return response()->json(['error'=> 'Usuarios não encontrados'], 404);
        }
    }
}
