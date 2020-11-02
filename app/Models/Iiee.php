<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Iiee extends Model
{
    use HasFactory;
    protected $table='iiees';
    public function grados(){
        //relacion de uno a muchos
        return $this->hasMany(Grado::class,'iiee_id');
    }
}
