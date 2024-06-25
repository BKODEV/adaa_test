<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Postulant extends Model
{
    use HasFactory;


    function offre() : BelongsTo {
        return $this->belongsTo(Recrutement::class, 'recrutement_id', "id");
    }
}
