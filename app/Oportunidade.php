<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunidade extends Model
{
    protected $with=['usuarios'];
    
    
    public function gestor(){
        return $this->belongsTo('App\Gestor','gestor_id');
    }
    public function usuarios(){
        return $this->belongsToMany('App\Usuario','usuarios_oportunidades','op_id','usuario_id');
    }
    protected $fillable = [
        'cod', 'type', 'ini_date','fin_date',
    ];
}
