<?php

namespace App\Database\DAO\MySQL;

use App\Database\DAO\DAO;
use App\Models\Parametro;
use Illuminate\Support\Facades\DB;

class ParametroDAO implements DAO
{
	// @Override
    public function insert(object $parametro): int {
        $id = DB::connection("multi-documents")->table("parametro")->insertGetId(
            [
                "titulo" => $parametro->titulo,
                "tipo" => $parametro->tipo,
                "regex" => $parametro->regex
            ]
        );

        return $id;
    }

    // @Override
    public function change(object $parametro): bool {
        return DB::connection("multi-documents")->update(
            "UPDATE parametro p SET p.titulo = ?, p.tipo = ?, p.regex = ? WHERE p.id = ?",
            [
                $parametro->titulo,
                $parametro->tipo,
                $parametro->regex,
                $parametro->id
            ]
        );
	}

    // @Override
    public function delete(int $id): int {
        return DB::connection("multi-documents")->delete("DELETE FROM parametro WHERE id = ?", [$id]);
	}

    // @Override
    public function get(int $id): Parametro | null {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT p.id, p.titulo, p.tipo, p.regex FROM parametro p WHERE p.id = ?",
            [$id]
        );

        return (!empty($res)) ? new Parametro($res->id, $res->titulo, $res->tipo, $res->regex) : null;
	}

    public function getIdParametro(string $titulo, string $tipo): int {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT p.id FROM parametro p WHERE p.titulo = ? AND p.tipo = ?",
            [
                $titulo,
                $tipo
            ]
        );

        return (!empty($res)) ? $res->id : 0;
	}

    // @Override
    public function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null {
        $parameters = array();
        $res = DB::connection("multi-documents")->select(
            "SELECT DISTINCT(p.id), p.titulo, p.tipo, p.regex FROM parametro p " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY p." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : "")
        );

        if (!empty($res)) {
            foreach ($res as $parametro) {
                array_push($parameters, new Parametro($parametro->id, $parametro->titulo, $parametro->tipo, $parametro->regex));
            }
        }

        return $parameters;
	}

    // @Override
    public function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array | null {
        $parameters = array();
        $res = DB::connection("multi-documents")->select(
            "SELECT DISTINCT(p.id), p.titulo, p.tipo, p.regex FROM parametro p WHERE p.titulo LIKE ? OR p.tipo LIKE ? " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY p." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : ""),
            [
                "%" . $q . "%",
                "%" . $q . "%"
            ]
        );

        if (!empty($res)) {
            foreach ($res as $parametro) {
                array_push($parameters, new Parametro($parametro->id, $parametro->titulo, $parametro->tipo, $parametro->regex));
            }
        }

        return $parameters;
	}

    // @Override
    public function count(): int {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(p.id) AS qtd FROM parametro p"
        );

        return $res->qtd;
	}

    // @Override
    public function countFind(string $q): int {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(DISTINCT(p.id)) AS qtd FROM parametro p WHERE p.titulo LIKE ? OR p.tipo LIKE ?",
            [
                "%" . $q . "%",
                "%" . $q . "%"
            ]
        );

        return $res->qtd;
	}
}
