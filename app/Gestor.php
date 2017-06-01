<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    public function oportunidades(){
        return $this->hasMany('App\Oportunidade','gestor_id');
    }
    protected $fillable = [
        'name', 'email', 'password'
    ];
}
