<?php

namespace App\Database\MySQL\DAO;

use App\Database\DAO;
use App\Models\Documento;
use Illuminate\Support\Facades\DB;

class DocumentoDAO implements DAO
{
	// @Override
    /** @var Parametro[] */
    public function insert(object $documento): int {
        $id = DB::connection("multi-documents")->table("usuario")->insertGetId(
            [
                "nome" => $documento->nome,
                "pais" => $documento->pais,
                "descricao" => $documento->descricao,
            ]
        );

        return $id;
    }

    // @Override
    public function change(object $documento): bool {
        return DB::connection("multi-documents")->update(
            "UPDATE documento d SET d.nome = ?, d.pais = ?, d.descricao = ? WHERE d.id = ?",
            [
                $documento->nome,
                $documento->pais,
                $documento->descricao,
                $documento->id
            ]
        );
	}

    // @Override
    public function delete(int $id): int {
        return DB::connection("multi-documents")->delete("DELETE FROM documento WHERE id = ?", [$id]);
	}

    // @Override
    public function get(int $id): object {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT d.id, d.nome, d.pais, d.descricao FROM documento d WHERE d.id = ?",
            [$id]
        );

        return (!empty($res)) ? new Documento($res->id, $res->nome, $res->pais, $res->descricao) : null;
	}

    // @Override
    public function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array {
        $docs = array();
        $res = DB::connection("multi-documents")->select(
            "SELECT d.id, d.nome, d.pais, d.descricao FROM documento d " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY d." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : "")
        );

        if (!empty($res)) {
            foreach ($res as $documento) {
                array_push($docs, new Documento($documento->id, $documento->nome, $documento->pais, $documento->descricao));
            }
        }

        return $docs;
	}

    // @Override
    public function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array {
        $docs = array();
        $res = DB::connection("multi-documents")->select(
            "SELECT DISTINCT(d.id), d.nome, d.pais, d.descricao FROM documento d WHERE d.nome LIKE ? OR d.pais LIKE ? OR d.descricao LIKE ? " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY d." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : ""),
            [
                "%" . $q . "%",
                "%" . $q . "%",
                "%" . $q . "%"
            ]
        );

        if (!empty($res)) {
            foreach ($res as $documento) {
                array_push($docs, new Documento($documento->id, $documento->nome, $documento->pais, $documento->descricao));
            }
        }

        return $docs;
	}

    // @Override
    public function count(): int {
        $users = array();
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(d.id) AS qtd FROM documento d"
        );

        return $res->qtd;
	}

    // @Override
    public function countFind(string $q): int {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(DISTINCT(d.id)) AS qtd FROM documento d WHERE d.nome LIKE ? OR d.pais LIKE ? OR d.descricao LIKE ?",
            [
                "%" . $q . "%",
                "%" . $q . "%",
                "%" . $q . "%"
            ]
        );

        return $res->qtd;
	}
}
