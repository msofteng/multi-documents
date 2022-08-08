<?php

namespace App\Services;

use App\Database\MySQL\DAO\DocumentoUsuarioDAO;
use App\Services\Service;

use Illuminate\Http\Request;

class DocumentoUsuarioService implements Service {

    public DocumentoUsuarioDAO $documentoUsuarioDao;

    public function __construct() {
        $this->documentoUsuarioDao = new DocumentoUsuarioDAO();
    }

    public function create(Request $request): int {
        $data = $request->all();
        return $this->documentoUsuarioDao->insert(json_decode(json_encode($data)));
    }

    public function update(Request $request): bool {
        $data = $request->all();
        return $this->documentoUsuarioDao->change(json_decode(json_encode($data)));
    }

    public function delete(Request $request): int {
        $data = $request->all();
        return $this->documentoUsuarioDao->delete($data["id"]);
    }

    public function get(Request $request): object | null {
        $data = $request->all();
        return $this->documentoUsuarioDao->get((isset($data["id"]) && !empty($data["id"])) ? $data["id"] : 0);
    }

    public function data(int $id): object | null {
        return $this->documentoUsuarioDao->get($id);
    }

    public function listAll(Request $request): array | null {
        $data = $request->all();
        return $this->documentoUsuarioDao->list((isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function findAll(Request $request): array | null {
        $data = $request->all();
        return $this->documentoUsuarioDao->find($data["q"], (isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function countRows(): int {
        return $this->documentoUsuarioDao->count();
    }

    public function countSearchLines(Request $request): int {
        $data = $request->all();
        return $this->documentoUsuarioDao->countFind($data["q"]);
    }
}
