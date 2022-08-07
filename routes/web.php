<?php

use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
    --------------------------------------------------------------------------
                                ROTAS DA WEB
    --------------------------------------------------------------------------
    Aqui é onde você pode registrar rotas da web para seu aplicativo. Essas
    rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
    contém o grupo de middleware "web". Agora crie algo grande!
*/

// INTRODUÇÃO (API)

Route::get("/", function () {
    return view("index");
});


// rotas (usuário)

Route::post("/api/usuario/salvar", function (Request $request) {
    return view("index"); // FALTA AQUI
});

Route::put("/api/usuario/atualizar", function (Request $request) {
    return view("index"); // FALTA AQUI
});

Route::delete("/api/usuario/excluir", function (Request $request) {
    return view("index"); // FALTA AQUI
});

Route::get("/api/usuario", function (Request $request) {
    $usuario = (new UsuarioService())->get($request);
    return (!empty($usuario)) ? response($usuario->toString(), 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "O usuário não foi encontrado"], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/usuarios", function (Request $request) {
    $usuarios = (new UsuarioService())->listAll($request);
    return (!empty($usuarios)) ? response($usuarios, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "Os usuários não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/usuarios/buscar", function (Request $request) {
    $usuarios = (new UsuarioService())->findAll($request);
    return (!empty($usuarios)) ? response($usuarios, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "Os usuários não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/usuarios/total", function (Request $request) {
    return view("index"); // FALTA AQUI
});

Route::get("/api/usuarios/buscar/total", function (Request $request) {
    return view("index"); // FALTA AQUI
});


// rotas (documento)

Route::post("/api/documento/salvar", function (Request $request) {
    return view("index");
});

Route::put("/api/documento/atualizar", function (Request $request) {
    return view("index");
});

Route::delete("/api/documento/excluir", function (Request $request) {
    return view("index");
});

Route::get("/api/documento", function (Request $request) {
    return view("index");
});

Route::get("/api/documentos", function (Request $request) {
    return view("index");
});

Route::get("/api/documentos/buscar", function (Request $request) {
    return view("index");
});



// rotas (parâmetro)

Route::post("/api/parametro/salvar", function (Request $request) {
    return view("index");
});

Route::put("/api/parametro/atualizar", function (Request $request) {
    return view("index");
});

Route::delete("/api/parametro/excluir", function (Request $request) {
    return view("index");
});

Route::get("/api/parametro", function (Request $request) {
    return view("index");
});

Route::get("/api/parametros", function (Request $request) {
    return view("index");
});

Route::get("/api/parametros/buscar", function (Request $request) {
    return view("index");
});


// rotas (documentos_usuario)

Route::post("/api/usuario/documento/adicionar", function (Request $request) {
    return view("index");
});

Route::put("/api/usuario/documento/atualizar", function (Request $request) {
    return view("index");
});

Route::delete("/api/usuario/documento/excluir", function (Request $request) {
    return view("index");
});

Route::get("/api/usuario/documento", function (Request $request) {
    return view("index");
});

Route::get("/api/usuario/documentos", function (Request $request) {
    return view("index");
});

Route::get("/api/usuarios/documento", function (Request $request) {
    return view("index");
});

Route::get("/api/usuarios/documentos", function (Request $request) {
    return view("index");
});

Route::get("/api/usuarios/buscar", function (Request $request) {
    return view("index");
});

Route::get("/api/usuario/documentos/buscar", function (Request $request) {
    return view("index");
});

Route::get("/api/usuarios/documentos/buscar", function (Request $request) {
    return view("index");
});


// rotas (dados_documento)

Route::post("/api/documento/dados/salvar", function (Request $request) {
    return view("index");
});

Route::put("/api/documento/dados/atualizar", function (Request $request) {
    return view("index");
});

Route::delete("/api/documento/dados/excluir", function (Request $request) {
    return view("index");
});

Route::get("/api/documento/dados", function (Request $request) {
    return view("index");
});

Route::get("/api/documentos/dados", function (Request $request) {
    return view("index");
});

Route::get("/api/documentos/dados/buscar", function (Request $request) {
    return view("index");
});


Route::get("/home", function () {
    return view("index");
});
