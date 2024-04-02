<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Empresa;
use App\Models\Vagas;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    protected $empresas;

    public function __construct(Empresa $empresa)
    {
        $this->empresas = $empresa;
    }

    function list()
    {
        $empresas = $this->empresas->with("vagas")->get()->toArray();

        if ($empresas == null) return ["msg" => "Nenhuma empresa cadastrada"];
        return $empresas;
    }

    function create(Request $request)
    {
        $requestData = $request->all();
        $requestData["password"] = Hash::make($requestData["password"]);

        $result = $this->empresas->create($requestData);
        return $result;
    }

    function show($id)
    {
        $empresa = $this->empresas->with("vagas")->find($id);
        if ($empresa == null) return ["msg" => "Nenhum resultado encontrado"];
        return $empresa;
    }

    function update(Request $request, $id)
    {
        $requestData = $request->all();
        $empresa = $this->empresas->with("vagas")->find($id);

        if ($empresa == null) {
            return ["msg" => "Empresa não encontrada"];
        }
        foreach ($requestData as $key => $value) {
            if (key_exists($key, $empresa->toArray())) {
                $empresa[$key] = $requestData[$key];
            }
        }
        $empresa->save();

        return $empresa;
    }

    function delete($id)
    {
        $empresa = $this->empresas->with("vagas")->find($id);

        if ($empresa == null) return ["msg" => "Empresa não encontrada"];

        $empresa = $empresa->delete();
        if ($empresa) return ["msg" => "Deletado com sucesso"];
    }
}
