<?php

namespace App\Models;

use App\Database\DAO;

class DadoDocumentoDAO implements DAO
{
	// @Override
    public function insert(object $json): int {
        return "";
    }

    // @Override
    public function change(object $json): bool {
        return "";
	}

    // @Override
    public function delete(int $id): int {
        return "";
	}

    // @Override
    public function get(int $id): object | null {
        return json_decode("");
	}

    // @Override
    public function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null {
        return array();
	}

    // @Override
    public function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null {
        return array();
	}

    // @Override
    public function count(): int {
        return 1;
	}

    // @Override
    public function countFind(string $q): int {
        return 1;
	}
}
