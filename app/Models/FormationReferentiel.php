<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationReferentiel extends Model
{
    use HasFactory;
    protected $table = "formation_referentiel";
    public $timestamps = false ;
    protected $fillable = [
        'formation_id',
        'referentiel_id'
    ] ;
}
