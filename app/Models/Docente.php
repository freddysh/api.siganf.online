<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    public function user(){
        //relacion de uno a muchos
        return $this->belongsTo(User::class,'user_id');
    }
    public function iiee(){
        //relacion de uno a muchos
        return $this->belongsTo(Iiee::class,'iiee_id');
    }
}
