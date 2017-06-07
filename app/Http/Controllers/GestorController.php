<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Gestor as gestor;

class GestorController extends Controller
{
    //
    function __construct(){}

    public function list() {
        $gestors = gestor::all();            
        if(!$gestors->isEmpty()){
            return response()->json($gestors, 200);
        }else{
            return response()->json(['error'=> 'Gestores não encontrados'], 404);
        }
    }
    public function read($id){
        $gestor = gestor::find($id);
        if($gestor){
            return response()->json($gestor, 200);
        }else{
            return response()->json(['error'=> 'Gestor não encontrado'], 404);
        }
    }
    public function create(Request $request) {
        $gestor = new Gestor;
             
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|unique:gestors',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=> 'Email ja cadastrado!'], 500);
        }

        $input = $request->all();
        @$gestor->name = @$input['name'];
        @$gestor->password = @$input['password'];
        @$gestor->email = @$input['email'];
        $gestor->save();
        return response()->json(['success'=> 'Gestor Cadsatrado com sucesso'], 200);
    }
    public function update(Request $request,$id){

        $gestor=gestor::find($id);
        $input = $request->all();
       
        if($gestor){
            @$gestor->name = @$input['name'];
            #@$gestor->password = @$input['password'];
            @$gestor->email = @$input['email'];
            $gestor->save();
            return response()->json($gestor, 200);
        }else{
            return response()->json(['error'=> 'Gestor não encontrado'], 404);
        }
    }
    public function updatepass(Request $request,$id){
        
        $gestor=usuario::find($id);
        $input = $request->all();
       
        if($gestor){
            $gestor->password = @$input['password'];
            $gestor->save();
            return response()->json($gestor, 200);
        }else{
            return response()->json(['error'=> 'Gestor não encontrado'], 404);
        }
    }
    public function delete($id){
        $gestor = gestor::find($id);
        if($gestor){
            if($gestor->delete()){
                return response()->json(['message'=> 'Gestor deletado'], 200);
            }else{
                return response()->json(['error'=> 'Erro ao Deletar Gestor'], 500);
            }
        }else{
            return response()->json(['error'=> 'Gestor não encontrado'], 404);   
        }
    }
    public function login(Request $request){
        $gestors = gestor::all();
        $input = $request->all();
        if(!$gestors->isEmpty()){
            foreach($gestors as $gestor){
                if(($input['email']===$gestor->email)&&($input['password']===$gestor->password)){
                    return response()->json([
                        'logado' => 1,
                        'gestor_id' => $gestor->id,
                        'gestor_email' => $gestor->email,
                        'type' => 'gestor'
                    ]);
                }
            }
        }else{
            return response()->json(['error'=> 'Gestores não encontrados'], 404);
        }
    }
}
