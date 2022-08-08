<?php

use App\Services\UsuarioService;
use App\Services\DocumentoService;
use App\Services\ParametroService;
use App\Services\DadoDocumentoService;
use App\Services\DocumentoUsuarioService;
use App\Util\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psy\Exception\TypeErrorException;

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

Route::get("/home", function () {
    return view("index");
});


/*
    # # # Rotas do CRUD (REST) # # #

    estes endpoints foram pensados na possibilidade de construir uma SPA que irá
    trabalhar com Angular, React ou até mesmo com algum framework JavaScript avançado
    utilizando bibliotecas jQuery onde várias requisições assíncronas serão chamadas
    conforme os usuários (administradores) forem inserindo os dados

    Validação: no Postman seria muito trabalhoso tratar o payload JSON para verificar
    se todos os atributos estão inseridos nele, portanto na documentação irei mostrar o
    payload que cada rota deverá possuir para a requisição ser efetuada com sucesso

    Também na documentação se der tempo irei especificar quais atributos devem ou
    não serem preenchidos
*/

// rotas (usuário)

Route::post("/api/usuario/salvar", function (Request $request) {
    try {
        $service = new UsuarioService();
        $id = $service->create($request);
        return ($id > 0) ? response(["message" => "O usuário foi cadastrado com sucesso", "usuario" => $service->user($id)], 206, ["Content-Type" => "application/json"]) : response(["message" => "ERRO: O usuário não foi cadastrado"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::put("/api/usuario/atualizar", function (Request $request) {
    try {
        $bool = (new UsuarioService())->update($request);
        return ($bool) ? response(["message" => "O usuário foi atualizado com sucesso"], 200, ["Content-Type" => "application/json"]) : response(["message" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::delete("/api/usuario/excluir", function (Request $request) {
    try {
        $rows = (new UsuarioService())->delete($request);
        return ($rows > 0) ? response(["message" => "O usuário foi excluído com sucesso"], 204, ["Content-Type" => "application/json"]) : response(["message" => "O usuário não foi encontrado"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }

});

Route::get("/api/usuario", function (Request $request) {
    try {
        $usuario = (new UsuarioService())->get($request);
        return (!empty($usuario)) ? response($usuario->toString(), 200, ["Content-Type" => "application/json"]) : response(["message" => "O usuário não foi encontrado"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/usuarios", function (Request $request) {
    try {
        $usuarios = (new UsuarioService())->listAll($request);
        return (!empty($usuarios)) ? response($usuarios, 200, ["Content-Type" => "application/json"]) : response(["message" => "Os usuários não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/usuarios/buscar", function (Request $request) {
    try {
        $usuarios = (new UsuarioService())->findAll($request);
        return (!empty($usuarios)) ? response($usuarios, 200, ["Content-Type" => "application/json"]) : response(["message" => "Os usuários não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }

});

Route::get("/api/usuarios/total", function (Request $request) {
    try {
        $qtd = (new UsuarioService())->countRows();
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/usuarios/buscar/total", function (Request $request) {
    try {
        $qtd = (new UsuarioService())->countSearchLines($request);
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});


// rotas (documento)

Route::post("/api/documento/salvar", function (Request $request) {
    try {
        $service = new DocumentoService();
        $id = $service->create($request);
        return ($id > 0) ? response(["message" => "O documento foi cadastrado com sucesso", "documento" => $service->document($id)], 206, ["Content-Type" => "application/json"]) : response(["message" => "ERRO: O documento não foi cadastrado"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::put("/api/documento/atualizar", function (Request $request) {
    try {
        $bool = (new DocumentoService())->update($request);
        return ($bool) ? response(["message" => "O documento foi atualizado com sucesso"], 200, ["Content-Type" => "application/json"]) : response(["message" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::delete("/api/documento/excluir", function (Request $request) {
    try {
        $rows = (new DocumentoService())->delete($request);
        return ($rows > 0) ? response(["message" => "O documento foi excluído com sucesso"], 204, ["Content-Type" => "application/json"]) : response(["message" => "O documento não foi encontrado"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documento", function (Request $request) {
    try {
        $documento = (new DocumentoService())->get($request);
        return (!empty($documento)) ? response($documento->toString(), 200, ["Content-Type" => "application/json"]) : response(["message" => "O documento não foi encontrado"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documentos", function (Request $request) {
    try {
        $documentos = (new DocumentoService())->listAll($request);
        return (!empty($documentos)) ? response($documentos, 200, ["Content-Type" => "application/json"]) : response(["message" => "Os documentos não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documentos/buscar", function (Request $request) {
    try {
        $usuarios = (new DocumentoService())->findAll($request);
        return (!empty($usuarios)) ? response($usuarios, 200, ["Content-Type" => "application/json"]) : response(["message" => "Os documentos não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documentos/total", function (Request $request) {
    try {
        $qtd = (new DocumentoService())->countRows();
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documentos/buscar/total", function (Request $request) {
    try {
        $qtd = (new DocumentoService())->countSearchLines($request);
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});



// rotas (parâmetro)

Route::post("/api/parametro/salvar", function (Request $request) {
    try {
        $service = new ParametroService();
        $id = $service->create($request);
        return ($id > 0) ? response(["message" => "O parâmetro foi cadastrado com sucesso", "parametro" => $service->parameter($id)], 206, ["Content-Type" => "application/json"]) : response(["message" => "ERRO: O parâmetro não foi cadastrado"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::put("/api/parametro/atualizar", function (Request $request) {
    try {
        $bool = (new ParametroService())->update($request);
        return ($bool) ? response(["message" => "O parâmetro foi atualizado com sucesso"], 200, ["Content-Type" => "application/json"]) : response(["message" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::delete("/api/parametro/excluir", function (Request $request) {
    try {
        $rows = (new ParametroService())->delete($request);
        return ($rows > 0) ? response(["message" => "O parâmetro foi excluído com sucesso"], 204, ["Content-Type" => "application/json"]) : response(["message" => "O parâmetro não foi encontrado"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/parametro", function (Request $request) {
    try {
        $parametro = (new ParametroService())->get($request);
        return (!empty($parametro)) ? response($parametro->toString(), 200, ["Content-Type" => "application/json"]) : response(["message" => "O parâmetro não foi encontrado"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/parametros", function (Request $request) {
    try {
        $parametros = (new ParametroService())->listAll($request);
        return (!empty($parametros)) ? response($parametros, 200, ["Content-Type" => "application/json"]) : response(["message" => "Os parâmetros não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/parametros/buscar", function (Request $request) {
    try {
        $parametros = (new ParametroService())->findAll($request);
        return (!empty($parametros)) ? response($parametros, 200, ["Content-Type" => "application/json"]) : response(["message" => "Os parâmetros não foram encontrados. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/parametros/total", function (Request $request) {
    try {
        $qtd = (new ParametroService())->countRows();
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/parametros/buscar/total", function (Request $request) {
    try {
        $qtd = (new ParametroService())->countSearchLines($request);
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});


// rotas (dados_documento)

Route::post("/api/documento/dados/adicionar", function (Request $request) {
    try {
        $service = new DadoDocumentoService();
        $id = $service->create($request);
        return ($id > 0) ? response(["message" => "A informação do documento foi cadastrada com sucesso", "informacao" => $service->info($id)], 206, ["Content-Type" => "application/json"]) : response(["message" => "ERRO: A informação do documento não foi cadastrada"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::put("/api/documento/dados/atualizar", function (Request $request) {
    try {
        $bool = (new DadoDocumentoService())->update($request);
        return ($bool) ? response(["message" => "A informação do documento foi atualizada com sucesso"], 200, ["Content-Type" => "application/json"]) : response(["message" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::delete("/api/documento/dados/excluir", function (Request $request) {
    try {
        $rows = (new DadoDocumentoService())->delete($request);
        return ($rows > 0) ? response(["message" => "A informação do documento foi excluída com sucesso"], 204, ["Content-Type" => "application/json"]) : response(["message" => "A informação do documento não foi encontrada"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documento/dado", function (Request $request) {
    try {
        $parametro = (new DadoDocumentoService())->get($request);
        return (!empty($parametro)) ? response(json_encode($parametro), 200, ["Content-Type" => "application/json"]) : response(["message" => "A informação do documento não foi encontrada"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documento/dados", function (Request $request) {
    try {
        $parametros = (new DadoDocumentoService())->listAll($request);
        return (!empty($parametros)) ? response(json_encode($parametros), 200, ["Content-Type" => "application/json"]) : response(["message" => "As informações do documento não foram encontradas. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documento/dados/buscar", function (Request $request) {
    try {
        $parametros = (new DadoDocumentoService())->findAll($request);
        return (!empty($parametros)) ? response(json_encode($parametros), 200, ["Content-Type" => "application/json"]) : response(["message" => "As informações do documento não foram encontradas. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documento/dados/total", function (Request $request) {
    try {
        $qtd = (new DadoDocumentoService())->countRows();
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/documento/dados/buscar/total", function (Request $request) {
    try {
        $qtd = (new DadoDocumentoService())->countSearchLines($request);
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});


// rotas (documentos_usuario)

Route::post("/api/usuario/documentos/adicionar", function (Request $request) {
    try {
        $service = new DocumentoUsuarioService();
        $id = $service->create($request);
        return ($id > 0) ? response(["message" => "A informação do usuário foi inserida no documento", "informacao" => $service->data($id)], 206, ["Content-Type" => "application/json"]) : response(["message" => "ERRO: A informação do usuário não foi inserida no documento"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::put("/api/usuario/documentos/atualizar", function (Request $request) {
    try {
        $bool = (new DocumentoUsuarioService())->update($request);
        return ($bool) ? response(["message" => "A informação do usuário foi atualizada no documento"], 200, ["Content-Type" => "application/json"]) : response(["message" => "ERRO!"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::delete("/api/usuario/documentos/excluir", function (Request $request) {
    try {
        $rows = (new DocumentoUsuarioService())->delete($request);
        return ($rows > 0) ? response(["message" => "A informação do usuário foi excluida no documento"], 204, ["Content-Type" => "application/json"]) : response(["message" => "A informação do usuário não foi encontrada"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/usuario/documento", function (Request $request) {
    try {
        $dado = (new DocumentoUsuarioService())->get($request);
        return (!empty($dado)) ? response(json_encode($dado), 200, ["Content-Type" => "application/json"]) : response(["message" => "A informação do usuário não foi encontrada"], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/usuario/documentos", function (Request $request) {
    try {
        $dados = (new DocumentoUsuarioService())->listAll($request);
        return (!empty($dados)) ? response(json_encode($dados), 200, ["Content-Type" => "application/json"]) : response(["message" => "As informações do usuário não foram encontradas. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/usuario/documentos/buscar", function (Request $request) {
    try {
        $dados = (new DocumentoUsuarioService())->findAll($request);
        return (!empty($dados)) ? response(json_encode($dados), 200, ["Content-Type" => "application/json"]) : response(["message" => "As informações do usuário não foram encontradas. Verifique as informações e tente novamente mais tarde."], 500, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/usuario/documentos/total", function (Request $request) {
    try {
        $qtd = (new DocumentoUsuarioService())->countRows();
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});

Route::get("/api/usuario/documentos/buscar/total", function (Request $request) {
    try {
        $qtd = (new DocumentoUsuarioService())->countSearchLines($request);
        return response(["qtd" => $qtd], 200, ["Content-Type" => "application/json"]);
    } catch (Exception | Error $ex) {
        return response(Util::formatException($ex), 500, ["Content-Type" => "application/json"]);
    }
});



/*
    # # # Rotas Avançadas (REST) # # #

    modelos de como estas requisições serão construídas e persistidas na base de dados
    está localizada em: ./public/json

    irá fazer acesso com um super serviço (Analytics) que irá modelar os exemplos contidos na
    pasta ./public/json e consumir todos os outros serviços da API para
    persistir todos os dados em apenas uma única rota
*/
