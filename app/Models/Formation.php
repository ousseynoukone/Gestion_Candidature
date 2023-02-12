<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    public $timestamps = false ;
    protected $fillable = [
        'nom',
        'duree',
        'description',
        'isStarted',
        'date_debut'
    ] ;

    public function referentiels(){
        return $this->belongsToMany(Referentiel::class);
    }

    public function candidats(){
        return $this->belongsToMany(Candidat::class);
    }

}
