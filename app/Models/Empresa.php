<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ["email", "password", "nome", "ramo"];
    protected $hidden = ["password"];
    use HasFactory;


    public function vagas()
    {
        return $this->hasMany(Vagas::class, "empresa_id", "id");
    }
}
