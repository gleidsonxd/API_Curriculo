<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    public function usuario(){
        return $this->belongsTo('App\Usuario','usuario_id');
    }
    protected $fillable = [
        'lattes', 'linkedin', 'cur_job','exp_prof','skill','archive'
    ];
}
