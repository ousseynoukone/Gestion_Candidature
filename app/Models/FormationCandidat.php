<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationCandidat extends Model
{
    use HasFactory;
    public $timestamps = false ;
    protected $table = "user_formation";

    protected $fillable = [
        'formation_id',
        'user_id'
    ] ;
}
