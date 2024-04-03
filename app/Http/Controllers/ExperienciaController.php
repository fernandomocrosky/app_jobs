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
        $experiencia = $this->experiencias->with("candidato")->get();

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

    public function show($id)
    {
        $experiencia = $this->experiencias->with("candidato")->find($id);

        if ($experiencia) return $experiencia;

        return ["msg" => "Não encontrado"];
    }

    public function update(Request $request, $id)
    {

        $requestData = $request->all();
        $experiencia = $this->experiencias->find($id);

        if ($experiencia) {
            foreach ($requestData as $key => $value) {
                if ($key == "candidato_id") continue;
                $experiencia[$key] = $requestData[$key];
            }

            $experiencia->save();
            return $experiencia;
        }

        return ["msg" => "Não encontrado"];
    }


    public function delete($id)
    {
        $experiencia = $this->experiencias->find($id);

        if ($experiencia) {
            $resultado = $experiencia->delete();
            if ($resultado) return ["msg" => "Deletado com sucesso"];
        }

        return ["msg" => "Não encontrado"];
    }
}
