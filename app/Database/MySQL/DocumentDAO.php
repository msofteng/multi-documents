<?php

namespace App\Database\MySQL;

use App\Models\Documento;

interface DocumentoDAO
{
    public static function insert(Documento $obj): int;

    public static function change(Documento $json): bool;

    public static function delete(int $id): int;

    public static function get(int $id): Documento;

    /**
     * @return Documento[]
     */

    public static function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array;

    /**
     * @return Documento[]
     */

    public static function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array;

    public static function count(): int;

    public static function countFind(string $q): int;
}
