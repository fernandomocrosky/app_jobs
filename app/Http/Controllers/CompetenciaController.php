<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use Illuminate\Http\Request;

class CompetenciaController extends Controller
{
    protected $competencias;

    public function __construct(Competencia $competencias)
    {
        $this->competencias = $competencias;
    }

    function list()
    {
        $competencias = $this->competencias->with("candidatos")->get();

        if ($competencias->toArray()) return $competencias;

        return ["msg" => "Não encontrado"];
    }

    function create(Request $request)
    {
        $requestData = $request->all();
        $competencia = $this->competencias->create($requestData);
        if (!$competencia) return ["msg" => "Erro"];
        return $competencia;
    }

    function show($id)
    {
        $competencia = $this->competencias->find($id);

        if ($competencia) return $competencia;

        return ["msg" => "Não encontrado"];
    }

    function update(Request $request, $id)
    {
        $requestData = $request->all();
        $competencia  = $this->competencias->find($id);

        if ($competencia) {
            foreach ($requestData as $key => $value) {
                $competencia[$key] = $requestData[$key];
            }

            $competencia->save();
            return $competencia;
        }
        return ["msg" => "Não encontrado"];
    }

    function delete($id)
    {
        $competencia = $this->competencias->find($id);

        if ($competencia) {
            $success = $competencia->delete();
            $msg = $success ? ["msg" => "deletado com sucesso"] : ["msg" => "Erro ao deletar"];
            return $msg;
        }
        return ["msg" => "delete oh yes"];
    }
}
