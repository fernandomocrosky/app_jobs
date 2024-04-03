<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $fillable = ["nome"];
    use HasFactory;

    public function candidatos()
    {
        return $this->belongsToMany(Candidato::class, "candidato_competencia", "competencia_id", "candidato_id");
    }
}
