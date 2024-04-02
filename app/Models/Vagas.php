<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vagas extends Model
{
    protected $fillable = ["nome", "divulgavel", "disponivel", "descricao"];
    use HasFactory;


    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
