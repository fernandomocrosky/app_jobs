<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = ["nome", "ramo", "password", "email", "faixa_salarial"];
    protected $hidden = ["password", "created_at", "updated_at"];

    protected $casts = [
        "password" => "hashed"
    ];

    use HasFactory;

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class, "candidato_id", "id");
    }

    public function competencias()
    {
        return $this->belongsToMany(Competencia::class, "candidato_competencia", "candidato_id", "competencia_id");
    }

    public function vagas()
    {
        return $this->belongsToMany(Vagas::class, "candidato_vaga", "vaga_id", "candidato_id");
    }
}
