<?php

namespace App\Database;

interface DAO
{
    public function insert(object $obj): int;

    public function change(object $json): bool;

    public function delete(int $id): int;

    public function get(int $id): object | null;

    public function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null;

    public function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null;

    public function count(): int;

    public function countFind(string $q): int;
}
