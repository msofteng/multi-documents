<?php

namespace App\Services;

use App\Database\DAO\MySQL\DadoDocumentoDAO;
use App\Database\DAO\MySQL\DAOUtil;
use Exception;
use App\Services\Service;

use Illuminate\Http\Request;

class DadoDocumentoService implements Service {

    public DadoDocumentoDAO $dadoDocumentoDao;

    public function __construct() {
        $this->dadoDocumentoDao = new DadoDocumentoDAO();
    }

    public function create(Request $request): int {
        $data = $request->all();
        $exists = DAOUtil::isInfo($data["label"], $data["parametro_id"], $data["documento_id"]);
        return (!$exists) ? $this->dadoDocumentoDao->insert(json_decode(json_encode($data))) : throw new Exception("A informação já foi cadastrada", 1062);
    }

    public function update(Request $request): bool {
        $data = $request->all();
        $bool = $this->dadoDocumentoDao->change(json_decode(json_encode($data)));
        return ($bool) ? $bool : throw new Exception("ERRO!");
    }

    public function delete(Request $request): int {
        $data = $request->all();
        $rows = $this->dadoDocumentoDao->delete($data["id"]);
        return ($rows > 0) ? $rows : throw new Exception("A informação do documento não foi encontrada");
    }

    public function get(Request $request): object | null {
        $data = $request->all();
        $dadoDocumento = $this->dadoDocumentoDao->get((isset($data["id"]) && !empty($data["id"])) ? $data["id"] : 0);
        return (!empty($dadosDocumento)) ? $dadoDocumento : throw new Exception("A informação do documento não foi encontrada");
    }

    public function info(int $id): object | null {
        return $this->dadoDocumentoDao->get($id);
    }

    public function listAll(Request $request): array | null {
        $data = $request->all();
        $dadosDocumentos = $this->dadoDocumentoDao->list((isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
        return (!empty($dadosDocumentos)) ? $dadosDocumentos : throw new Exception("As informações do documento não foram encontradas. Verifique as informações e tente novamente mais tarde.");
    }

    public function findAll(Request $request): array | null {
        $data = $request->all();
        $dadosDocumentos = $this->dadoDocumentoDao->find($data["q"], (isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
        return (!empty($dadosDocumentos)) ? $dadosDocumentos : throw new Exception("As informações do documento não foram encontradas. Verifique as informações e tente novamente mais tarde.");
    }

    public function countRows(): int {
        return $this->dadoDocumentoDao->count();
    }

    public function countSearchLines(Request $request): int {
        $data = $request->all();
        return $this->dadoDocumentoDao->countFind($data["q"]);
    }
}
