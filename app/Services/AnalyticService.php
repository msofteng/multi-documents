<?php

namespace App\Services;

use App\Database\DAO\MySQL\DadoDocumentoDAO;
use App\Database\DAO\MySQL\DAOAnalytic;
use App\Database\DAO\MySQL\DAOUtil;
use App\Database\DAO\MySQL\DocumentoDAO;
use App\Database\DAO\MySQL\DocumentoUsuarioDAO;
use App\Database\DAO\MySQL\ParametroDAO;
use App\Database\DAO\MySQL\UsuarioDAO;
use App\Models\Documento;
use App\Models\Usuario;
use App\Models\Local;
use App\Models\Parametro;
use App\Util\Util;
use Exception;
use Illuminate\Http\Request;

class AnalyticService {
    public DAOAnalytic $analyticDao;

    public function __construct() {
        $this->analyticDao = new DAOAnalytic();
    }

    public function salvarUsuario(Request $request): int {
        $data = $request->all();
        $exists = DAOUtil::isUsuario($data["user"]);
        $documentoDao = new DocumentoDAO();
        $usuarioDao = new UsuarioDAO();
        $documentoUsuarioDao = new DocumentoUsuarioDAO();
        $idUsuario = (!$exists) ? $usuarioDao->insert(new Usuario(null, $data["nome"], $data["user"], $data["senha"], new Local($data["local"]["nome"], $data["local"]["localizacao"]["latitude"], $data["local"]["localizacao"]["longitude"]), $data["token"])) : throw new Exception("O usuário já foi cadastrado", 1062);

        foreach ($data["documents"] as $documento) {
            $bool = DAOUtil::isDocumento($documento["nome"], $documento["pais"]);
            $doc = ($bool) ? $documentoDao->getDocumentByNameAndCountry($documento["nome"], $documento["pais"]) : throw new Exception("O documento [" . $documento["nome"] . "] não está cadastrado");
            $dadosDocumento = $this->getDadosDocumentoById($doc->id);

            $dadosUsuario = $documento["dados"];

            ksort($dadosUsuario);
            if (count($dadosDocumento) != count(array_keys($dadosUsuario)) && $dadosUsuario != Util::getParametros($dadosDocumento)) throw new Exception("Os parâmetros do documento '" . $documento["nome"] . "' estão incorretos");

            foreach ($dadosDocumento as $dado) {
                $documentoUsuarioDao->insert(json_decode(json_encode(array("valor" => $documento["dados"][$dado["parametro"]], "dado_documento_id" => $dado["id"], "usuario_id" => $idUsuario))));
            }
        }

        return $idUsuario;
    }

    public function salvarDocumento(Request $request): int {
        $data = $request->all();
        $documentoId = 0;
        $documentoDao = new DocumentoDAO();
        $parametroDao = new ParametroDAO();
        $dadoDocumentoDao = new DadoDocumentoDAO();

        $bool = DAOUtil::isDocumento($data["nome"], $data["pais"]);
        $documentoId = (!$bool) ? $documentoDao->insert(new Documento(null, $data["nome"], $data["pais"], $data["descricao"])) : throw new Exception("O documento já foi cadastrado");

        foreach ($data["dados"] as $dado) {
            $boolP = DAOUtil::isParametro($dado["parametro"], $dado["tipo"]);
            $parametroId = (!$boolP) ? $parametroDao->insert(new Parametro(null, $dado["parametro"], $dado["tipo"], $dado["regex"])) : $parametroDao->getIdParametro($dado["parametro"], $dado["tipo"]);
            $idP = $dadoDocumentoDao->insert(json_decode(json_encode(array("label" => $dado["info"]["label"], "title" => $dado["info"]["title"], "placeholder" => $dado["info"]["placeholder"], "parametro_id" => $parametroId, "documento_id" => $documentoId))));
        }

        return $documentoId;
    }

    public function getDocumento(Request $request): array | null {
        $data = $request->all();
        $doc = $this->analyticDao->document($data["id"]);
        return (!empty($doc)) ? $doc : throw new Exception("O documento não foi encontrado");
    }

    public function document(int $id): array | null {
        $doc = $this->analyticDao->document($id);
        return (!empty($doc)) ? $doc : throw new Exception("O documento não foi encontrado");
    }

    public function getDadosDocumento(Request $request): array | null {
        $data = $request->all();
        $doc = $this->analyticDao->documentData($data["id"]);
        return (!empty($doc)) ? $doc : throw new Exception("O documento com suas informações não foi encontrado");
    }

    public function getDadosDocumentoById(int $id): array | null {
        $doc = $this->analyticDao->documentData($id);
        return (!empty($doc)) ? $doc : throw new Exception("O documento com suas informações não foi encontrado");
    }

    public function getUsuario(Request $request): array | null {
        $data = $request->all();
        $user = $this->analyticDao->usuario($data["id"]);

        if (!empty($user)) {
            $docs = array();
            $documentos = $this->getDocsUsuarioById($data["id"]);

            foreach ($documentos as $documento) {
                array_push($docs, array("nome" => $documento->nome, "dados" => $this->analyticDao->docUsuario($documento->id, $data["id"])));
            }

            $user["documentos"] = $docs;

            return $user;
        } else {
            throw new Exception("O usuário não foi encontrado");
        }
    }

    public function user(int $id): array | null {
        $user = $this->analyticDao->usuario($id);

        if (!empty($user)) {
            $docs = array();
            $documentos = $this->getDocsUsuarioById($id);

            foreach ($documentos as $documento) {
                array_push($docs, array("nome" => $documento->nome, "dados" => $this->analyticDao->docUsuario($documento->id, $id)));
            }

            $user["documentos"] = $docs;

            return $user;
        } else {
            throw new Exception("O usuário não foi encontrado");
        }
    }

    public function getDocsUsuario(Request $request): array | null {
        $data = $request->all();
        $docs = $this->analyticDao->docsUsuario($data["id"]);
        return (!empty($docs)) ? $docs : throw new Exception("Os documentos deste usuário não foram encontrados");
    }

    public function getDocsUsuarioById(int $id): array | null {
        $docs = $this->analyticDao->docsUsuario($id);
        return (!empty($docs)) ? $docs : throw new Exception("Os documentos deste usuário não foram encontrados");
    }
}
