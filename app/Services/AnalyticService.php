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

    public function getDadosDocumento(Request $request): object {
        return json_decode("{}");
    }

    public function getUsuario(Request $request): object {
        return json_decode("{}");
    }

    public function getUsuarioLite(Request $request): object {
        return json_decode("{}");
    }

    public function getUsuarioDocs(Request $request): object {
        return json_decode("{}");
    }
}
