<?php

namespace App\Services;

use App\Database\DAO\MySQL\DAOAnalytic;
use Exception;
use Illuminate\Http\Request;

class AnalyticService {
    public DAOAnalytic $analyticDao;

    public function __construct() {
        $this->analyticDao = new DAOAnalytic();
    }

    public function salvarUsuario(Request $request): object {
        return json_decode("{}");
    }

    public function salvarDocumento(Request $request): object {
        return json_decode("{}");
    }

    public function getDocumento(Request $request): array | null {
        $data = $request->all();
        $doc = $this->analyticDao->document($data["id"]);
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
