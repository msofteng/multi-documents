<?php

namespace App\Services;

use App\Database\DAO\MySQL\DocumentoUsuarioDAO;
use App\Database\DAO\MySQL\DAOUtil;
use Exception;
use App\Services\Service;

use Illuminate\Http\Request;

class DocumentoUsuarioService implements Service {

    public DocumentoUsuarioDAO $documentoUsuarioDao;

    public function __construct() {
        $this->documentoUsuarioDao = new DocumentoUsuarioDAO();
    }

    public function create(Request $request): int {
        $data = $request->all();
        $exists = DAOUtil::isData($data["dado_documento_id"], $data["usuario_id"]);
        return (!$exists) ? $this->documentoUsuarioDao->insert(json_decode(json_encode($data))) : throw new Exception("A informação do usuário já foi cadastrada", 1062);
    }

    public function update(Request $request): bool {
        $data = $request->all();
        $bool = $this->documentoUsuarioDao->change(json_decode(json_encode($data)));
        return ($bool) ? $bool : throw new Exception("ERRO!");
    }

    public function delete(Request $request): int {
        $data = $request->all();
        $rows = $this->documentoUsuarioDao->delete($data["id"]);
        return ($rows > 0) ? $rows : throw new Exception("A informação do usuário não foi encontrada");
    }

    public function get(Request $request): object | null {
        $data = $request->all();
        $dado = $this->documentoUsuarioDao->get((isset($data["id"]) && !empty($data["id"])) ? $data["id"] : 0);
        return (!empty($dado)) ? $dado : throw new Exception("A informação do usuário não foi encontrada");

    }

    public function data(int $id): object | null {
        return $this->documentoUsuarioDao->get($id);
    }

    public function listAll(Request $request): array | null {
        $data = $request->all();
        $dados = $this->documentoUsuarioDao->list((isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
        return (!empty($dados)) ? $dados : throw new Exception("As informações do usuário não foram encontradas. Verifique as informações e tente novamente mais tarde.");
    }

    public function findAll(Request $request): array | null {
        $data = $request->all();
        $dados = $this->documentoUsuarioDao->find($data["q"], (isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
        return (!empty($dados)) ? $dados : throw new Exception("As informações do usuário não foram encontradas. Verifique as informações e tente novamente mais tarde.");
    }

    public function countRows(): int {
        return $this->documentoUsuarioDao->count();
    }

    public function countSearchLines(Request $request): int {
        $data = $request->all();
        return $this->documentoUsuarioDao->countFind($data["q"]);
    }
}
