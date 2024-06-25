<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recrutement extends Model
{
    use HasFactory;



    function postulants() : HasMany {
        return $this->hasMany(Postulant::class);
    }
}
