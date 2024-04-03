<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    protected $fillable = ["empresa", "data_inicio", "data_termino"];
    protected $hidden = ["created_at", "updated_at"];

    protected $casts = [
        "data_inicio" => "datetime: d/m/Y",
        "data_termino" => "datetime: d/m/Y"
    ];

    use HasFactory;

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }
}
