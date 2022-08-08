<?php

use App\Services\UsuarioService;
use App\Services\DocumentoService;
use App\Services\ParametroService;
use App\Services\DadoDocumentoService;
use App\Services\DocumentoUsuarioService;
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
    $id = (new UsuarioService())->create($request);
    return ($id > 0) ? response(["message" => "O usuário foi cadastrado com sucesso"], 206, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO: O usuário não foi cadastrado"], 500, ["Content-Type" => "application/json"]);
});

Route::put("/api/usuario/atualizar", function (Request $request) {
    $bool = (new UsuarioService())->update($request);
    return ($bool) ? response(["message" => "O usuário foi atualizado com sucesso"], 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
});

Route::delete("/api/usuario/excluir", function (Request $request) {
    $rows = (new UsuarioService())->delete($request);
    return ($rows > 0) ? response(["message" => "O usuário foi excluído com sucesso"], 204, ["Content-Type" => "application/json"]) : response(["mensagem" => "O usuário não foi encontrado"], 500, ["Content-Type" => "application/json"]);
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
    $qtd = (new UsuarioService())->countRows();
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});

Route::get("/api/usuarios/buscar/total", function (Request $request) {
    $qtd = (new UsuarioService())->countSearchLines($request);
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});


// rotas (documento)

Route::post("/api/documento/salvar", function (Request $request) {
    $id = (new DocumentoService())->create($request);
    return ($id > 0) ? response(["message" => "O documento foi cadastrado com sucesso"], 206, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO: O documento não foi cadastrado"], 500, ["Content-Type" => "application/json"]);
});

Route::put("/api/documento/atualizar", function (Request $request) {
    $bool = (new DocumentoService())->update($request);
    return ($bool) ? response(["message" => "O documento foi atualizado com sucesso"], 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
});

Route::delete("/api/documento/excluir", function (Request $request) {
    $rows = (new DocumentoService())->delete($request);
    return ($rows > 0) ? response(["message" => "O documento foi excluído com sucesso"], 204, ["Content-Type" => "application/json"]) : response(["mensagem" => "O documento não foi encontrado"], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/documento", function (Request $request) {
    $documento = (new DocumentoService())->get($request);
    return (!empty($documento)) ? response($documento->toString(), 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "O documento não foi encontrado"], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/documentos", function (Request $request) {
    $documentos = (new DocumentoService())->listAll($request);
    return (!empty($documentos)) ? response($documentos, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "Os documentos não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/documentos/buscar", function (Request $request) {
    $usuarios = (new DocumentoService())->findAll($request);
    return (!empty($usuarios)) ? response($usuarios, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "Os documentos não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/documentos/total", function (Request $request) {
    $qtd = (new DocumentoService())->countRows();
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});

Route::get("/api/documentos/buscar/total", function (Request $request) {
    $qtd = (new DocumentoService())->countSearchLines($request);
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});



// rotas (parâmetro)

Route::post("/api/parametro/salvar", function (Request $request) {
    $id = (new ParametroService())->create($request);
    return ($id > 0) ? response(["message" => "O parâmetro foi cadastrado com sucesso"], 206, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO: O parâmetro não foi cadastrado"], 500, ["Content-Type" => "application/json"]);
});

Route::put("/api/parametro/atualizar", function (Request $request) {
    $bool = (new ParametroService())->update($request);
    return ($bool) ? response(["message" => "O parâmetro foi atualizado com sucesso"], 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
});

Route::delete("/api/parametro/excluir", function (Request $request) {
    $rows = (new ParametroService())->delete($request);
    return ($rows > 0) ? response(["message" => "O parâmetro foi excluído com sucesso"], 204, ["Content-Type" => "application/json"]) : response(["mensagem" => "O parâmetro não foi encontrado"], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/parametro", function (Request $request) {
    $parametro = (new ParametroService())->get($request);
    return (!empty($parametro)) ? response($parametro->toString(), 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "O parâmetro não foi encontrado"], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/parametros", function (Request $request) {
    $parametros = (new ParametroService())->listAll($request);
    return (!empty($parametros)) ? response($parametros, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "Os parâmetros não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/parametros/buscar", function (Request $request) {
    $parametros = (new ParametroService())->findAll($request);
    return (!empty($parametros)) ? response($parametros, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "Os parâmetros não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/parametros/total", function (Request $request) {
    $qtd = (new ParametroService())->countRows();
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});

Route::get("/api/parametros/buscar/total", function (Request $request) {
    $qtd = (new ParametroService())->countSearchLines($request);
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});


// rotas (dados_documento)

Route::post("/api/documento/dados/adicionar", function (Request $request) {
    $id = (new DadoDocumentoService())->create($request);
    return ($id > 0) ? response(["message" => "A informação do documento foi cadastrada com sucesso"], 206, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO: A informação do documento não foi cadastrada"], 500, ["Content-Type" => "application/json"]);
});

Route::put("/api/documento/dados/atualizar", function (Request $request) {
    $bool = (new DadoDocumentoService())->update($request);
    return ($bool) ? response(["message" => "A informação do documento foi atualizada com sucesso"], 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
});

Route::delete("/api/documento/dados/excluir", function (Request $request) {
    $rows = (new DadoDocumentoService())->delete($request);
    return ($rows > 0) ? response(["message" => "A informação do documento foi excluída com sucesso"], 204, ["Content-Type" => "application/json"]) : response(["mensagem" => "A informação do documento não foi encontrada"], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/documento/dado", function (Request $request) {
    $parametro = (new DadoDocumentoService())->get($request);
    return (!empty($parametro)) ? response($parametro->toString(), 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "A informação do documento não foi encontrada"], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/documento/dados", function (Request $request) {
    $parametros = (new DadoDocumentoService())->listAll($request);
    return (!empty($parametros)) ? response($parametros, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "As informações do documento não foram encontradas. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/documento/dados/buscar", function (Request $request) {
    $parametros = (new DadoDocumentoService())->findAll($request);
    return (!empty($parametros)) ? response($parametros, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "As informações do documento não foram encontradas. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/documento/dados/total", function (Request $request) {
    $qtd = (new DadoDocumentoService())->countRows();
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});

Route::get("/api/documento/dados/buscar/total", function (Request $request) {
    $qtd = (new DadoDocumentoService())->countSearchLines($request);
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});


// rotas (documentos_usuario)

Route::post("/api/usuario/documentos/salvar", function (Request $request) {
    $id = (new DocumentoUsuarioService())->create($request);
    return ($id > 0) ? response(["message" => "A informação do usuário foi inserida no documento"], 206, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO: A informação do usuário não foi inserida no documento"], 500, ["Content-Type" => "application/json"]);
});

Route::put("/api/usuario/documentos/atualizar", function (Request $request) {
    $bool = (new DocumentoUsuarioService())->update($request);
    return ($bool) ? response(["message" => "A informação do usuário foi atualizada no documento"], 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
});

Route::delete("/api/usuario/documentos/excluir", function (Request $request) {
    $rows = (new DocumentoUsuarioService())->delete($request);
    return ($rows > 0) ? response(["message" => "A informação do usuário foi excluida no documento"], 204, ["Content-Type" => "application/json"]) : response(["mensagem" => "A informação do usuário não foi encontrada"], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/usuario/documento", function (Request $request) {
    $parametro = (new DocumentoUsuarioService())->get($request);
    return (!empty($parametro)) ? response($parametro->toString(), 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "A informação do usuário não foi encontrada"], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/usuario/documentos", function (Request $request) {
    $parametros = (new DocumentoUsuarioService())->listAll($request);
    return (!empty($parametros)) ? response($parametros, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "As informações do usuário não foram encontradas. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/usuario/documentos/buscar", function (Request $request) {
    $parametros = (new DocumentoUsuarioService())->findAll($request);
    return (!empty($parametros)) ? response($parametros, 200, ["Content-Type" => "application/json"]) : response(["mensagem" => "As informações do usuário não foram encontradas. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
});

Route::get("/api/usuario/documentos/total", function (Request $request) {
    $qtd = (new DocumentoUsuarioService())->countRows();
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});

Route::get("/api/usuario/documentos/buscar/total", function (Request $request) {
    $qtd = (new DocumentoUsuarioService())->countSearchLines($request);
    return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
});


Route::get("/home", function () {
    return view("index");
});
