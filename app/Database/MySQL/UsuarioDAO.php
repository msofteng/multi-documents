<?php

namespace App\Database\MySQL;

use App\Models\Usuario;

interface UsuarioDAO
{
    public static function insert(Usuario $obj): int;

    public static function change(Usuario $json): bool;

    public static function delete(int $id): int;

    public static function get(int $id): Usuario;

    /**
     * @return Usuario[]
     */

    public static function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array;

    /**
     * @return Usuario[]
     */

    public static function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array;

    public static function count(): int;

    public static function countFind(string $q): int;
}