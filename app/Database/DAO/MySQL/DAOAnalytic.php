<?php

namespace App\Database\DAO\MySQL;

use App\Database\DAO;
use Illuminate\Support\Facades\DB;

class DAOAnalytic
{
    public function document(int $id): array | null { // #1
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT JSON_OBJECT('nome', doc.nome, 'pais', doc.pais, 'descricao', doc.descricao, 'dados', (SELECT JSON_ARRAYAGG(JSON_OBJECT('parametro', p.titulo, 'tipo', p.tipo, 'regex', p.regex, 'info', JSON_OBJECT('label', dd.label, 'title', dd.title, 'placeholder', dd.placeholder))) FROM documento doc, dados_documento dd, parametro p WHERE dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = ?)) AS `json` FROM documento doc WHERE doc.id = ?",
            [
                $id,
                $id
            ]
        );

        return (!empty($res->json)) ? json_decode($res->json, true) : null;
    }

    public function documentData(int $id): array { // #2
        $res = DB::connection("multi-documents")->selectOne(
            "SELECT JSON_ARRAYAGG(JSON_OBJECT('parametro', p.titulo, 'tipo', p.tipo, 'regex', p.regex, 'info', JSON_OBJECT('label', dd.label, 'title', dd.title, 'placeholder', dd.placeholder))) AS `json` FROM documento doc, dados_documento dd, parametro p WHERE dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = ?",
            [

            ]
        );

        return json_decode($res->json, true);
    }

    public function usuario(int $id): object { // #3
        $res = DB::connection("multi-documents")->selectOne(
            "",
            [

            ]
        );

        return json_decode($res->json, true);
    }

    public function usuarioDoc(int $documentId): object { // #4
        $res = DB::connection("multi-documents")->selectOne(
            "",
            [

            ]
        );

        return json_decode($res->json, true);
    }

    public function usuarioDocs(int $id): object { // #5
        $res = DB::connection("multi-documents")->selectOne(
            "",
            [

            ]
        );

        return json_decode($res->json, true);
    }
}
