<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Class_;

class Referentiel extends Model
{
    use HasFactory;

    public $timestamps = false ;
    protected $fillable = [
        'libelle',
        'validated',
        'horaire',
        'type_id',
    ] ;

    public function formations(){
        return $this->belongsToMany(Formation::class);
    }

    public function types(){
        return $this->belongsTo(Type::class,"type_id");
    }
}
