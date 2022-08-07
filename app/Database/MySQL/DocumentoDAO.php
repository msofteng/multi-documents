<?php

namespace App\Models;

use App\Database\MySQL\DAO;

class DocumentoDAO implements DAO
{
	// @Override
    public static function insert(object $documento): int {
        return "";
    }

    // @Override
    public static function change(object $documento): bool {
        return "";
	}

    // @Override
    public static function delete(int $id): int {
        return "";
	}

    // @Override
    public static function get(int $id): Documento {
        return new Documento();
	}

    // @Override
    public static function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array {
        return array(new Documento(), new Documento());
	}

    // @Override
    public static function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array {
        return array(new Documento(), new Documento());
	}

    // @Override
    public static function count(string $coluna = null, string $ordem = null): int {
        return 1;
	}

    // @Override
    public static function countFind(string $q, string $coluna = null, string $ordem = null): int {
        return 1;
	}
}
