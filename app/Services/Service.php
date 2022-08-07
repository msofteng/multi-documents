<?php

namespace App\Services;

use Illuminate\Http\Request;

interface Service
{
    public function create(Request $request): int;

    public function update(Request $request): bool;

    public function delete(Request $request): int;

    public function get(Request $request): object | null;

    public function listAll(Request $request): array | null;

    public function findAll(Request $request): array | null;

    public function countRows(): int;

    public function countSearchLines(Request $request): int;
}
