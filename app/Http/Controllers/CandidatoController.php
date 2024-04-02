<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use Illuminate\Support\Facades\Hash;

class CandidatoController extends Controller
{
    private $candidato;

    public function __construct(Candidato $candidato)
    {
        $this->candidato = $candidato;
    }

    function list()
    {
        $data = $this->candidato->all();
        // $data = Candidato::all()->toArray();
        return $data;
    }

    function create(Request $request)
    {
        $requestData = $request->all();
        $requestData["password"] = Hash::make($requestData["password"]);
        $candidato = $this->candidato->create($requestData);
        return $candidato;
    }

    function show($id)
    {
        $candidato = $this->candidato->find($id);
        if ($candidato != null) {
            return $candidato;
        };

        return ["msg" => "Candidato não existe"];
    }

    function update(Request $request, $id)
    {
        $requestData = $request->all();
        $candidato = $this->candidato->find($id);

        foreach ($requestData as $key => $value) {
            if (key_exists($key, $candidato->toArray())) {
                $candidato[$key] = $requestData[$key];
            }

            $candidato->save();

            return $candidato;
        }
    }

    function delete($id)
    {
        $candidato = $this->candidato->find($id);
        if ($candidato != null) {
            $candidato->delete();
            return ["msg" => "deletado com sucesso"];
        }
        return ["msg" => "Candidato não existe"];
    }
}
