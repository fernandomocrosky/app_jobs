<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Vagas;
use Illuminate\Http\Request;

class VagasController extends Controller
{
    protected $vagas;
    protected $empresa;

    public function __construct(Vagas $vagas, Empresa $empresa)
    {
        $this->vagas = $vagas;
        $this->empresa = $empresa;
    }


    function list()
    {
        $vagas = $this->vagas
            ->with("empresa")
            ->with("candidatos")
            ->get()
            ->toArray();
        if ($vagas != null) {
            return $vagas;
        }
        return ["msg" => "Não existe vagas cadastradas"];
    }

    function create(Request $request)
    {
        $requestData = $request->all();
        $vaga = new Vagas();
        $vaga->fill($requestData);
        $empresa = $this->empresa->find($requestData["empresa_id"]);
        $vaga->empresa()->associate($empresa);
        $vaga->save();

        return $vaga;
    }

    function show($id)
    {
        $vaga = $this->vagas->find($id);

        if ($vaga != null) {
            return $vaga;
        }

        return ["msg" => "Não foram encontradas vagas"];
    }

    function update(Request $request, $id)
    {
        $requestData = $request->all();
        $vaga = $this->vagas->find($id);

        if ($vaga == null) return ["msg" => "Não existe vaga"];
        foreach ($requestData as $key => $value) {
            if (key_exists($key, $vaga->toArray())) {
                $vaga[$key] = $requestData[$key];
            }
        }

        $vaga->save();
        return $vaga;
    }

    function delete($id)
    {
        $vaga = $this->vagas->find($id);

        if ($vaga == null) return ["msg" => "Não existe vaga"];

        return $vaga->delete();
    }
}
