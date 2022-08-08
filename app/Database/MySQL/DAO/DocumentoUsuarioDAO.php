<?php

namespace App\Database\MySQL\DAO;

use App\Database\DAO;
use Illuminate\Support\Facades\DB;

class DocumentoUsuarioDAO implements DAO
{
	// @Override
    public function insert(object $data): int {
        $id = DB::connection("multi-documents")->table("documentos_usuario")->insertGetId(
            [
                "valor" => $data->valor,
                "dado_documento_id" => $data->dado_documento_id,
                "usuario_id" => $data->usuario_id
            ]
        );

        return $id;
    }

    // @Override
    public function change(object $data): bool {
        return DB::connection("multi-documents")->update(
            "UPDATE documentos_usuario d SET d.valor = ?, d.dado_documento_id = ?, d.usuario_id = ? WHERE d.id = ?",
            [
                $data->valor,
                $data->dado_documento_id,
                $data->usuario_id,
                $data->id
            ]
        );
	}

    // @Override
    public function delete(int $id): int {
        return DB::connection("multi-documents")->delete("DELETE FROM documentos_usuario WHERE id = ?", [$id]);
	}

    // @Override
    public function get(int $id): object | null {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT d.id, d.valor, d.dado_documento_id, d.usuario_id FROM documentos_usuario d WHERE d.id = ?",
            [$id]
        );

        return (!empty($res)) ? $res : null;
	}

    // @Override
    public function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null {
        $res = DB::connection("multi-documents")->select(
            "SELECT d.id, d.valor, d.dado_documento_id, d.usuario_id FROM documentos_usuario d " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY d." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : "")
        );

        return (!empty($res)) ? $res : null;
	}

    // @Override
    public function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null {
        $res = DB::connection("multi-documents")->select(
            "SELECT DISTINCT(d.id), d.valor, d.dado_documento_id, d.usuario_id FROM documentos_usuario d WHERE d.valor LIKE ? " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY d." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : ""),
            [
                "%" . $q . "%"
            ]
        );
        return (!empty($res)) ? $res : null;
	}

    // @Override
    public function count(): int {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(d.id) AS qtd FROM documentos_usuario d"
        );

        return $res->qtd;
	}

    // @Override
    public function countFind(string $q): int {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(DISTINCT(d.id)) AS qtd FROM documentos_usuario d WHERE d.valor LIKE ?",
            [
                "%" . $q . "%"
            ]
        );

        return $res->qtd;
	}
}
