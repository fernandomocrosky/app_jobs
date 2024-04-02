<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = ["nome", "ramo", "password", "email", "faixa_salarial"];
    protected $hidden = ["password"];
    use HasFactory;

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class, "candidato_id", "id");
    }
}
