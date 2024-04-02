<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Experiencia;
use Illuminate\Http\Request;

class ExperienciaController extends Controller
{
    protected $experiencias;
    protected $candidatos;

    public function __construct(Experiencia $experiencias, Candidato $candidatos)
    {
        $this->experiencias = $experiencias;
        $this->candidatos = $candidatos;
    }


    public function list()
    {
        $experiencia = $this->experiencias->with("candidatos")->all();

        if ($experiencia->toArray() == null) return ["msg" => "Nenhuma experiencia encontrada"];

        return $experiencia;
    }

    public function create(Request $request)
    {
        $requestData = $request->all();

        $experiencia = new Experiencia();
        $experiencia->fill($requestData);

        $candidato = $this->candidatos->find($requestData["candidato_id"]);
        $experiencia->candidato()->associate($candidato);

        $experiencia->save();

        return $experiencia;
    }
}
