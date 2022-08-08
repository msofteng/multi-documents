<?php

namespace App\Database\DAO\MySQL;

use Illuminate\Support\Facades\DB;

class DAOUtil
{
    public static function isUsuario(string $user): bool {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT IF((SELECT u.id FROM usuario u WHERE u.user = ?) IS NOT NULL, true, false) AS `exists`",
            [
                $user
            ]
        );

        return (bool) $res->exists;
    }

    public static function isDocumento(string $nome, string $pais): bool {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT IF((SELECT d.id FROM documento d WHERE d.nome = ? AND d.pais = ?) IS NOT NULL, true, false) AS `exists`",
            [
                $nome,
                $pais
            ]
        );

        return (bool) $res->exists;
    }

    public static function isParametro(string $titulo, string $tipo): bool {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT IF((SELECT p.id FROM parametro p WHERE p.titulo = ? AND p.tipo = ?) IS NOT NULL, true, false) AS `exists`",
            [
                $titulo,
                $tipo
            ]
        );

        return (bool) $res->exists;
    }

    public static function isInfo(string $label, int $parametroId, int $documentoId): bool {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT IF((SELECT dd.id FROM dados_documento dd WHERE dd.label = ? AND dd.parametro_id = ? AND dd.documento_id = ?) IS NOT NULL, true, false) AS `exists`",
            [
                $label,
                $parametroId,
                $documentoId
            ]
        );

        return (bool) $res->exists;
    }

    public static function isData(int $dadoDocumentoId, int $usuarioId): bool {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT IF((SELECT du.id FROM documentos_usuario du WHERE du.dado_documento_id = ? AND du.usuario_id = ?) IS NOT NULL, true, false) AS `exists`",
            [
                $dadoDocumentoId,
                $usuarioId
            ]
        );

        return (bool) $res->exists;
    }
}
