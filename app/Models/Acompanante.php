<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acompanante extends Model
{
    use HasFactory;
    protected $table='acompanantes';
    public function iiee(){
        //relacion de uno a muchos
        return $this->belongsTo(Iiee::class,'iiee_id');
    }
}
