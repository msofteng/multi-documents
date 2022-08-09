<?php

namespace App\Services;

use App\Database\DAO\MySQL\DadoDocumentoDAO;
use App\Database\DAO\MySQL\DAOAnalytic;
use App\Database\DAO\MySQL\DAOUtil;
use App\Database\DAO\MySQL\DocumentoDAO;
use App\Database\DAO\MySQL\ParametroDAO;
use App\Models\Documento;
use App\Models\Parametro;
use Exception;
use Illuminate\Http\Request;

class AnalyticService {
    public DAOAnalytic $analyticDao;

    public function __construct() {
        $this->analyticDao = new DAOAnalytic();
    }

    public function salvarUsuario(Request $request): int {
        $data = $request->all();

        return 0;
    }

    public function salvarDocumento(Request $request): int {
        $data = $request->all();
        $documentoId = 0;
        $documentoDao = (new DocumentoDAO());
        $parametroDao = (new ParametroDAO());
        $dadoDocumentoDao = (new DadoDocumentoDAO());

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

    public function getUsuario(Request $request): array | null {
        $data = $request->all();
        $user = $this->analyticDao->usuario($data["id"]);
        return (!empty($user)) ? $user : throw new Exception("O usuário não foi encontrado");
    }

    public function getDocUsuarios(Request $request): array | null {
        $data = $request->all();
        $docs = $this->analyticDao->docUsuarios($data["id"]);
        return (!empty($docs)) ? $docs : throw new Exception("Os documentos dos usuários não foram encontrados");
    }

    public function getDocsUsuario(Request $request): array | null {
        $data = $request->all();
        $docs = $this->analyticDao->docsUsuario($data["id"]);
        return (!empty($docs)) ? $docs : throw new Exception("Os documentos deste usuário não foram encontrados");
    }
}
