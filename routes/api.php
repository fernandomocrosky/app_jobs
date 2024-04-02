<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\VagasController;


Route::prefix("/candidatos")->controller(CandidatoController::class)->group(function () {

  Route::get("/", "list");
  Route::post("/", "create");


  Route::get("/{id}", "show");
  Route::put("/{id}", "update");
  Route::delete("/{id}", "delete");
});


Route::prefix("/vagas")->controller(VagasController::class)->group(function () {
  Route::get("/", "list");
  Route::post("/", "create");

  Route::get("/{id}", "show");
  Route::put("/{id}", "update");
  Route::delete("/{id}", "delete");
});

Route::prefix("/empresas")->controller(EmpresaController::class)->group(function () {
  Route::get("/", "list");
  Route::post("/", "create");

  Route::get("/{id}", "show");
  Route::put("/{id}", "update");
  Route::delete("/{id}", "delete");
});


Route::prefix("/experiencias")->controller(ExperienciaController::class)->group(function () {
  Route::get("/", "list");
  Route::post("/", "create");
});
