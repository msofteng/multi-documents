<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $addHttpCookie = true;
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        "api/usuario/salvar",
        "api/usuario/atualizar",
        "api/usuario/excluir",
        "api/documento/salvar",
        "api/documento/atualizar",
        "api/documento/excluir",
        "api/parametro/salvar",
        "api/parametro/atualizar",
        "api/parametro/excluir",
        "/api/documento/dados/adicionar",
        "/api/documento/dados/atualizar",
        "/api/documento/dados/excluir",
        "/api/usuario/documentos/adicionar",
        "/api/usuario/documentos/atualizar",
        "/api/usuario/documentos/excluir",
        "/analytics/documento",
        "/analytics/documento/dados",
        "/analytics/usuario",
        "/analytics/usuario/documentos",
        "/analytics/documento/salvar",
        "/analytics/usuario/salvar"
    ];
}
