<?php

namespace App\Database\MySQL\DAO;

use App\Database\DAO;
use Illuminate\Support\Facades\DB;

class DAOUtil
{
    public static function isUsuario(string $user): bool {
        return true;
    }

    public static function isDocumento(string $nome, string $pais): bool {
        return true;
    }

    public static function isParametro(string $titulo, string $tipo): bool {
        return true;
    }

    public static function isInfo(string $label, int $parametroId, int $documento): bool {
        return true;
    }

    public static function isData(int $dadoDocumentoId, int $usuarioId): bool {
        return true;
    }
}
