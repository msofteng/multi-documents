<?php

namespace App\Services;

use App\Database\MySQL\DAO\DadoDocumentoDAO;
use App\Services\Service;

use Illuminate\Http\Request;

class DadoDocumentoService implements Service {

    public DadoDocumentoDAO $dadoDocumentoDao;

    public function __construct() {
        $this->dadoDocumentoDao = new DadoDocumentoDAO();
    }

    public function create(Request $request): int {
        $data = $request->all();
        return $this->dadoDocumentoDao->insert(json_decode(json_encode($data)));
    }

    public function update(Request $request): bool {
        $data = $request->all();
        return $this->dadoDocumentoDao->change(json_decode(json_encode($data)));
    }

    public function delete(Request $request): int {
        $data = $request->all();
        return $this->dadoDocumentoDao->delete($data["id"]);
    }

    public function get(Request $request): object | null {
        $data = $request->all();
        return $this->dadoDocumentoDao->get((isset($data["id"]) && !empty($data["id"])) ? $data["id"] : 0);
    }

    public function info(int $id): object | null {
        return $this->dadoDocumentoDao->get($id);
    }

    public function listAll(Request $request): array | null {
        $data = $request->all();
        return $this->dadoDocumentoDao->list((isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function findAll(Request $request): array | null {
        $data = $request->all();
        return $this->dadoDocumentoDao->find($data["q"], (isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function countRows(): int {
        return $this->dadoDocumentoDao->count();
    }

    public function countSearchLines(Request $request): int {
        $data = $request->all();
        return $this->dadoDocumentoDao->countFind($data["q"]);
    }
}
