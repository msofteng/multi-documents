<?php

namespace App\Database\MySQL\DAO;

use App\Database\DAO;
use Illuminate\Support\Facades\DB;

class DAOAnalytic
{
    public function document(int $id): object {
        return json_decode("{}");
    }

    public function documentData(int $id): object {
        return json_decode("{}");
    }

    public function usuario(int $id): object {
        return json_decode("{}");
    }

    public function usuarioLite(int $id): object {
        return json_decode("{}");
    }

    public function usuarioDocs(int $id): object {
        return json_decode("{}");
    }
}
