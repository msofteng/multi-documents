<?php

namespace App\Services;

use App\Database\DAO\MySQL\DadoDocumentoDAO;
use App\Database\DAO\MySQL\DocumentoDAO;
use App\Database\DAO\MySQL\DocumentoUsuarioDAO;
use App\Database\DAO\MySQL\DAOUtil;
use Exception;
use App\Models\Documento;
use App\Services\Service;

use Illuminate\Http\Request;

class DocumentoService implements Service {

    public DocumentoDAO $documentoDao;

    public function __construct() {
        $this->documentoDao = new DocumentoDAO();
    }

    public function create(Request $request): int {
        $data = $request->all();
        $exists = DAOUtil::isDocumento($data["nome"], $data["pais"]);

        if (!$exists) {
            return $this->documentoDao->insert(new Documento(null, $data["nome"], $data["pais"], $data["descricao"]));
        } else {
            throw new Exception("O documento já foi cadastrado", 1062);
        }
    }

    public function update(Request $request): bool {
        $data = $request->all();
        return $this->documentoDao->change(new Documento($data["id"], $data["nome"], $data["pais"], $data["descricao"]));
    }

    public function delete(Request $request): int {
        $data = $request->all();
        $dadoDocumentoDao = new DadoDocumentoDAO();
        $documentoUsuarioDao = new DocumentoUsuarioDAO();
        $dados = $dadoDocumentoDao->getAllByDocumentId($data["id"]);

        if (!empty($dados)) {
            foreach ($dados as $dado) {
                $documentoUsuarioDao->deleteAllByDataId($dado->id);
            }
        }

        $dadoDocumentoDao->deleteAllByDocumentId($data["id"]);

        return $this->documentoDao->delete($data["id"]);
    }

    public function get(Request $request): object | null {
        $data = $request->all();
        return $this->documentoDao->get((isset($data["id"]) && !empty($data["id"])) ? $data["id"] : 0);
    }

    public function document(int $id): Documento | null {
        return $this->documentoDao->get($id);
    }

    public function listAll(Request $request): array | null {
        $data = $request->all();
        return $this->documentoDao->list((isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function findAll(Request $request): array | null {
        $data = $request->all();
        return $this->documentoDao->find($data["q"], (isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function countRows(): int {
        return $this->documentoDao->count();
    }

    public function countSearchLines(Request $request): int {
        $data = $request->all();
        return $this->documentoDao->countFind($data["q"]);
    }
}
