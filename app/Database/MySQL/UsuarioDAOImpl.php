<?php

namespace App\Database\MySQL;

use App\Database\MySQL\DAO;
use App\Models\Usuario;
use App\Models\Local;
use Illuminate\Support\Facades\DB;

class UsuarioDAOImpl implements UsuarioDAO
{
	// @Override
    public static function insert(Usuario $usuario): int {

        $id = DB::connection("multi-documents")->table("usuario")->insertGetId(
            [
                "nome" => $usuario->getNome(),
                "local" => $usuario->getLocal()->getNome(),
                "user" => $usuario->getUser(),
                "senha" => DB::raw('sha2("' . $usuario->getSenha() . '", 256)'),
                "location" => DB::raw('POINT(' . $usuario->getLocal()->getLatitude() . ', ' . $usuario->getLocal()->getLongitude() . ')'),
                "token" => DB::raw('md5("'. $usuario->getToken() .'")')
            ]
        );

        return $id;
    }

    // @Override
    public static function change(Usuario $usuario): bool {
        return DB::connection("multi-documents")->update(
            "UPDATE usuario u SET u.nome = ?, u.local = ?, u.user = ?, u.senha = sha2(?, 256), u.location = POINT(?, ?), u.token = md5(?) WHERE u.id = 1",
            [
                $usuario->getNome(),
                $usuario->getLocal()->getNome(),
                $usuario->getUser(),
                $usuario->getSenha(),
                $usuario->getLocal()->getLatitude(),
                $usuario->getLocal()->getLongitude(),
                $usuario->getToken(),
                $usuario->getId()
            ]
        );
	}

    // @Override
    public static function delete(int $id): int {
        return DB::connection("multi-documents")->delete("DELETE FROM usuario WHERE id = ?", [$id]);
	}

    // @Override
    public static function get(int $id): Usuario {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT u.id, u.nome, u.local, u.user, u.senha, ST_X(u.location) AS latitude, ST_Y(u.location) AS longitude, u.token FROM usuario u WHERE u.id = ?",
            [$id]
        );

        return (!empty($res)) ? new Usuario($res->id, $res->nome, $res->user, $res->senha, new Local($res->local, $res->latitude, $res->longitude), $res->token) : null;
	}

    // @Override
    public static function list(string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array {
        $users = array();
        $res = DB::connection("multi-documents")->select(
            "SELECT u.id, u.nome, u.local, u.user, u.senha, ST_X(u.location) AS latitude, ST_Y(u.location) AS longitude, u.token FROM usuario u " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY u." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : "")
        );

        foreach ($res as $usuario) {
            array_push($users, new Usuario($usuario->id, $usuario->nome, $usuario->user, $usuario->senha, new Local($usuario->local, $usuario->latitude, $usuario->longitude), $usuario->token));
        }

        return $users;
	}

    // @Override
    public static function find(string $q, string $coluna = null, string $ordem = null, int $limit = null, int $offset = null): array {
        $users = array();
        $res = DB::connection("multi-documents")->select(
            "SELECT DISTINCT(u.id), u.nome, u.local, u.user, u.senha, ST_X(u.location) AS latitude, ST_Y(u.location) AS longitude, u.token FROM usuario u WHERE u.nome LIKE ? OR u.local LIKE ? OR u.user LIKE ? " . ((!empty($coluna) && !empty($ordem)) ? "ORDER BY u." . $coluna . " " . $ordem : "") . (($limit != null && $limit > 0) ? " LIMIT " . (int) $offset . ", " . $limit : ""),
            [
                "%" . $q . "%",
                "%" . $q . "%",
                "%" . $q . "%"
            ]
        );

        foreach ($res as $usuario) {
            array_push($users, new Usuario($usuario->id, $usuario->nome, $usuario->user, $usuario->senha, new Local($usuario->local, $usuario->latitude, $usuario->longitude), $usuario->token));
        }

        return $users;
	}

    // @Override
    public static function count(): int {
        $users = array();
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(u.id) AS qtd FROM usuario u"
        );

        return $res->qtd;
	}

    // @Override
    public static function countFind(string $q): int {
        $users = array();
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT COUNT(DISTINCT(u.id)) AS qtd FROM usuario u WHERE u.nome LIKE ? OR u.local LIKE ? OR u.user LIKE ?",
            [
                "%" . $q . "%",
                "%" . $q . "%",
                "%" . $q . "%"
            ]
        );

        return $res->qtd;
	}
}
