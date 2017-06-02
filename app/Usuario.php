<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    // protected $with=['curriculo'];
    public function curriculo(){
        return $this->hasOne('App\Curriculo','usuario_id');
    }

    public function oportunidades(){
        return $this->belongsToMany('App\Oportunidade','usuarios_oportunidades','usuario_id','op_id');
    }
    protected $fillable = [
        'name', 'email','cpf','tel'
    ];
    protected $hidden = ['password'];
       
}
