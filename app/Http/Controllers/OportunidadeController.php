<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Oportunidade as oportunidade;
use App\Usuario as usuario;

class OportunidadeController extends Controller
{
    function __construct(){}

    public function list(){
        $oportunidades = oportunidade::all();            
        if(!$oportunidades->isEmpty()){
            return response()->json($oportunidades, 200);
        }else{
            return response()->json(['error'=> 'Oportunidades não encontradas'], 404);
        }
    }
    public function read($id){
        $oportunidade = oportunidade::find($id);
        if($oportunidade){
            return response()->json($oportunidade, 200);
        }else{
            return response()->json(['error'=> 'Oportunidade não encontrada'], 404);
        }
    }
    public function create(Request $request) {
        $oportunidade = new Oportunidade;
        $input = $request->all();
    
        $oportunidade->cod = @$input['cod'];
        $oportunidade->type = @$input['type'];
        $oportunidade->ini_date = @$input['ini_date'];
        $oportunidade->fin_date = @$input['fin_date'];
        $oportunidade->gestor_id = @$input['gestor_id'];
        $oportunidade->save();
        return response()->json(['success'=> 'Oportunidade Cadsatrada com sucesso'], 200);
    }
    public function update(Request $request,$id){
        $oportunidade = oportunidade::find($id);
        $input = $request->all();
    
        if($oportunidade){
            $oportunidade->cod = @$input['cod'];
            $oportunidade->type = @$input['type'];
            $oportunidade->ini_date = @$input['ini_date'];
            $oportunidade->fin_date = @$input['fin_date'];
            $oportunidade->gestor_id = @$input['gestor_id'];
            $oportunidade->save();
            return response()->json($oportunidade, 200);
        }else{
            return response()->json(['error'=> 'Oportunidade não encontrada'], 404);
        }
    }
    public function delete($id){
        $oportunidade = oportunidade::find($id);
        if($oportunidade){
            if($oportunidade->delete()){
                return response()->json(['message'=> 'Oportunidade deletada'], 200);
            }else{
                return response()->json(['error'=> 'Erro ao Deletar Oportunidade'], 500);
            }
        }else{
            return response()->json(['error'=> 'Oportunidade não encontrada'], 404);
        }
    }
    #ID user e ID categoria, qnd user se inscreve esse metodo é chamado
    public function test($id){

        $oportunidade = oportunidade::find($id);
         $usuario = usuario::find(2);
        
        // $oportunidade->usuarios()->save($usuario);
         
        var_dump($oportunidade->usuarios);
    //   $oportunidade->usuarios->first()->name;
        // var_dump($oportunidade->usuarios->first());
    }
}