<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Curriculo as curriculo;

class CurriculoController extends Controller
{
    function __construct(){}

    public function list(){
        $curriculos = curriculo::all();            
        if(!$curriculos->isEmpty()){
            return response()->json($curriculos, 200);
        }else{
            return response()->json(['error'=> 'Curriculos não encontrados'], 404);
        }
    } 
    public function read($id){
        $curriculo = curriculo::find($id);
        if($curriculo){
            return response()->json($curriculo, 200);
        }else{
            return response()->json(['error'=> 'Curriculo não encontrado'], 404);
        }
    }
    public function create(Request $request) {
        $curriculo = new Curriculo;
        $input = $request->all();
    
        $curriculo->lattes = @$input['lattes'];
        $curriculo->linkedin = @$input['linkedin'];
        $curriculo->cur_job = @$input['cur_job'];
        $curriculo->exp_prof = @$input['exp_prof'];
        $curriculo->skill = @$input['skill'];
        $curriculo->archive = @$input['archive'];
        $curriculo->usuario_id = @$input['usuario_id'];
        $curriculo->save();
        return response()->json(['success'=> 'Curriculo Cadsatrado com sucesso'], 200);
    }
    public function update(Request $request,$id){
        $curriculo = curriculo::find($id);
        $input = $request->all();
    
        if($curriculo){
            $curriculo->lattes = @$input['lattes'];
            $curriculo->linkedin = @$input['linkedin'];
            $curriculo->cur_job = @$input['cur_job'];
            $curriculo->exp_prof = @$input['exp_prof'];
            $curriculo->skill = @$input['skill'];
            $curriculo->archive = @$input['archive'];
            $curriculo->usuario_id = @$input['usuario_id'];
            $curriculo->save();
            return response()->json($curriculo, 200);
        }else{
            return response()->json(['error'=> 'Curriculo não encontrado'], 404);
        }
    }
    public function delete($id){
        $curriculo = curriculo::find($id);
        if($curriculo){
            if($curriculo->delete()){
                return response()->json(['message'=> 'Curriculo deletado'], 200);
            }else{
                return response()->json(['error'=> 'Erro ao Deletar Curriculo'], 500);
            }
        }else{
            return response()->json(['error'=> 'Curriculo não encontrado'], 404);   
        }
    }
}
