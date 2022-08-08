<?php

namespace App\Services;

use App\Database\DAO\MySQL\DAOAnalytic;
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

    public function getDocumento(int $id): object {
        return json_decode("{}");
    }

    public function getDadosDocumento(int $id): object {
        return json_decode("{}");
    }

    public function getUsuario(int $id): object {
        return json_decode("{}");
    }

    public function getUsuarioLite(int $id): object {
        return json_decode("{}");
    }

    public function getUsuarioDocs(int $id): object {
        return json_decode("{}");
    }
}
