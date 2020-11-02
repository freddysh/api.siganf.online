<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesoria extends Model
{
    use HasFactory;
    public function dias(){
        //relacion de uno a muchos
        return $this->hasMany(Dia::class,'asesoria_id');
    }
    public function docente(){
        //relacion de uno a muchos
        return $this->belongsTo(User::class,'docente_id');
    }
    public function iiee(){
        //relacion de uno a muchos
        return $this->belongsTo(Iiee::class,'iiee_id');
    }
}
