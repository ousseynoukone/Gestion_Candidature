<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;
    public $timestamps = false;
    //si on respecte les conventions , il devient inutile de preciser ce qui suit 
    //   protected $table = 'projets';
    //  protected $primaryKey = 'id';
    protected $fillable = [
        "nom",
        "prenom",
        "email",
        "age",
        "niveauEtude",
        "sexe"

    ];

    public function formations(){
        return $this->belongsToMany(Formation::class);
    }

}
