<?php

namespace App\Models;

use App\Database\MySQL\DAO;

class UsuarioDAO implements DAO
{
	// @Override
    public static function insert(object $json): string {
        return "";
    }

    // @Override
    public static function update(object $json): string {
        return "";
	}

    // @Override
    public static function delete(int $id): string {
        return "";
	}

    // @Override
    public static function get(int $id): Usuario {
        return new Usuario();
	}

    // @Override
    public static function list(string $coluna, string $ordem, int $limit, int $offset): array {
        return array(new Usuario(), new Usuario());
	}

    // @Override
    public static function find(string $q, string $coluna, string $ordem, int $limit, int $offset): array {
        return array(new Usuario(), new Usuario());
	}

    // @Override
    public static function count(string $coluna, string $ordem): int {
        return 1;
	}

    // @Override
    public static function countFind(string $q, string $coluna, string $ordem): int {
        return 1;
	}
}
