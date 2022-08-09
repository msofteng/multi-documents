<?php

namespace App\Database\DAO\MySQL;

use App\Database\DAO;
use Illuminate\Support\Facades\DB;

class DAOAnalytic
{
    public function document(int $documentId): array | null {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT JSON_OBJECT('id', doc.id, 'nome', doc.nome, 'pais', doc.pais, 'descricao', doc.descricao, 'dados', (SELECT JSON_ARRAYAGG(JSON_OBJECT('parametro', p.titulo, 'tipo', p.tipo, 'regex', p.regex, 'info', JSON_OBJECT('label', dd.label, 'title', dd.title, 'placeholder', dd.placeholder))) FROM documento doc, dados_documento dd, parametro p WHERE dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = ?)) AS `json` FROM documento doc WHERE doc.id = ?",
            [
                $documentId,
                $documentId
            ]
        );

        return (!empty($res->json)) ? json_decode($res->json, true) : null;
    }

    public function documentData(int $documentId): array | null {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT JSON_ARRAYAGG(JSON_OBJECT('id', dd.id, 'documentoId', doc.id, 'parametro', p.titulo, 'tipo', p.tipo, 'regex', p.regex, 'info', JSON_OBJECT('label', dd.label, 'title', dd.title, 'placeholder', dd.placeholder))) AS `json` FROM documento doc, dados_documento dd, parametro p WHERE dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = ?",
            [
                $documentId
            ]
        );

        return (!empty($res->json)) ? json_decode($res->json, true) : null;
    }

    public function usuario(int $usuarioId): array | null {
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT JSON_OBJECT('id', u.id, 'nome', u.nome, 'user', u.user, 'local', JSON_OBJECT('nome', u.local, 'localizacao', JSON_OBJECT('latitude', ST_X(u.location), 'longitude', ST_Y(u.location)))) AS json FROM usuario u WHERE u.id = ?",
            [
                $usuarioId
            ]
        );

        return (!empty($res->json)) ? json_decode($res->json, true) : null;
    }

    public function docUsuario(int $documentoId, int $usuarioId): array | null {
        $users = array();
        $res = DB::connection("multi-documents")->selectOne(
            'SELECT REPLACE(REPLACE(REPLACE(REPLACE(JSON_ARRAYAGG(JSON_OBJECT(p.titulo, du.valor)), "{", ""), "}", ""), "[", "{"), "]", "}") AS `json` FROM usuario u, documentos_usuario du, dados_documento dd, documento doc, parametro p WHERE du.usuario_id = u.id AND du.dado_documento_id = dd.id AND dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = ? AND u.id = ?',
            [
                $documentoId,
                $usuarioId
            ]
        );

        return (!empty($res->json)) ? json_decode($res->json, true) : null;
    }

    public function docsUsuario(int $usuarioId): array | null { // #5
        $res = DB::connection("multi-documents")->select(
            "SELECT DISTINCT(doc.id), doc.nome FROM usuario u, documentos_usuario du, dados_documento dd, documento doc WHERE du.usuario_id = u.id AND du.dado_documento_id = dd.id AND dd.documento_id = doc.id AND u.id = ?",
            [
                $usuarioId
            ]
        );

        return (!empty($res)) ? $res : null;
    }
}
