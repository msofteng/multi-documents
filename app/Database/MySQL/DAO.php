<?php

namespace App\Database\MySQL;

use App\Models\Documento;
use App\Models\Usuario;

interface DAO
{
    public static function insert(object $json): int;

    public static function update(object $json): string | null;

    public static function delete(int $id): string | null;

    public static function get(int $id): Usuario | Documento | object;

    /**
     * @return Usuario[]
     * @return Documento[]
     */

    public static function list(string $coluna, string $ordem, int $limit, int $offset): array;

    /**
     * @return Usuario[]
     * @return Documento[]
     */

    public static function find(string $q, string $coluna, string $ordem, int $limit, int $offset): array;

    public static function count(string $coluna, string $ordem): int;

    public static function countFind(string $q, string $coluna, string $ordem): int;
}
