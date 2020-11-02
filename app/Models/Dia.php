<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;
    public function grados(){
        //relacion de uno a muchos
        return $this->hasMany(DiaGrado::class,'dia_id');
    }
    public function areaCurriculares(){
        //relacion de uno a muchos
        return $this->hasMany(DiaAreaCurricular::class,'dia_id');
    }
    public function p_18(){
        //relacion de uno a muchos
        return $this->hasMany(P_18::class,'dia_id');
    }
    public function competencias(){
        //relacion de uno a muchos
        return $this->hasMany(Competencia::class,'dia_id');
    }
    public function criterios(){
        //relacion de uno a muchos
        return $this->hasMany(Criterio::class,'dia_id');
    }
}
