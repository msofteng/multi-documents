<?php

namespace App\Database\MySQL\DAO;

use App\Database\DAO\DAO;
use Illuminate\Support\Facades\DB;

class DadoDocumentoDAO implements DAO
{
	// @Override
    public function insert(object $data): int {
        $id = DB::connection("multi-documents")->table("dados_documento")->insertGetId(
            [
                "label" => $data->label,
                "title" => $data->title,
                "placeholder" => $data->placeholder,
                "parametro_id" => $data->parametro_id,
                "documento_id" => $data->documento_id
            ]
        );

        return $id;
    }

    // @Override
    public function change(object $data): bool {
        return DB::connection("multi-documents")->update(
            "UPDATE dados_documento d SET d.label = ?, d.title = ?, d.placeholder = ?, d.parametro_id = ?, d.documento_id = ? WHERE d.id = ?",
            [
                $data->label,
                $data->title,
                $data->placeholder,
                $data->parametro_id,
                $data->documento_id,
                $data->id
            ]
        );
	}

    // @Override
    public function delete(int $id): int {
        return DB::connection("multi-documents")->delete("DELETE FROM dados_documento WHERE id = ?", [$id]);
	}

    public function deleteAllByDocumentId(int $id): int {
        (new DocumentoUsuarioDAO())->deleteAllByDataId($id);
        return DB::connection("multi-documents")->delete("DELETE FROM dados_documento WHERE documento_id = ?", [$id]);
	}

    // @Override
    public function get(int $id): object | null {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT d.id, d.label, d.title, d.placeholder, d.parametro_id, d.documento_id FROM dados_documento d WHERE d.id = ?",
            [$id]
        );

        return (!empty($res)) ? $res : null;
	}

    public function getAllByDocumentId(int $documentId): array | null {
        $res = DB::connection("multi-documents")->select(
            "SELECT d.id, d.label, d.title, d.placeholder, d.parametro_id, d.documento_id FROM dados_documento d WHERE d.documento_id = ?",
            [$documentId]
        );

        return (!empty($res)) ? $res : null;
	}

    public function getAllByParameterId(int $parameterId): array | null {
        $res = DB::connection("multi-documents")->select(
            "SELECT d.id, d.label, d.title, d.placeholder, d.parametro_id, d.documento_id FROM dados_documento d WHERE d.parametro_id = ?",
            [$parameterId]
        );

        return (!empty($res)) ? $res : null;
	}

    // @Override
    public function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null {
        $res = DB::connection("multi-documents")->select(
            "SELECT d.id, d.label, d.title, d.placeholder, d.parametro_id, d.documento_id FROM dados_documento d " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY d." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : "")
        );

        return (!empty($res)) ? $res : null;
	}

    // @Override
    public function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null {
        $res = DB::connection("multi-documents")->select(
            "SELECT DISTINCT(d.id), d.label, d.title, d.placeholder, d.parametro_id, d.documento_id FROM dados_documento d WHERE d.label LIKE ? OR d.title LIKE ? OR d.placeholder LIKE ? " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY d." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : ""),
            [
                "%" . $q . "%",
                "%" . $q . "%",
                "%" . $q . "%"
            ]
        );
        return (!empty($res)) ? $res : null;
	}

    // @Override
    public function count(): int {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(d.id) AS qtd FROM dados_documento d"
        );

        return $res->qtd;
	}

    // @Override
    public function countFind(string $q): int {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(DISTINCT(d.id)) AS qtd FROM dados_documento d WHERE d.label LIKE ? OR d.title LIKE ? OR d.placeholder LIKE ?",
            [
                "%" . $q . "%",
                "%" . $q . "%",
                "%" . $q . "%"
            ]
        );

        return $res->qtd;
	}
}
