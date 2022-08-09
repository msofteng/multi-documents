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
        return (!$exists) ? $this->documentoDao->insert(new Documento(null, $data["nome"], $data["pais"], $data["descricao"])) : throw new Exception("O documento já foi cadastrado", 1062);
    }

    public function update(Request $request): bool {
        $data = $request->all();
        $bool = $this->documentoDao->change(new Documento($data["id"], $data["nome"], $data["pais"], $data["descricao"]));
        return ($bool) ? $bool : throw new Exception("ERRO!");
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
        $rows = $this->documentoDao->delete($data["id"]);
        return ($rows > 0) ? $rows : throw new Exception("O documento não foi encontrado");
    }

    public function get(Request $request): object | null {
        $data = $request->all();
        $documento = $this->documentoDao->get((isset($data["id"]) && !empty($data["id"])) ? $data["id"] : 0);
        return (!empty($documento)) ? $documento : throw new Exception("O documento não foi encontrado");
    }

    public function document(int $id): Documento | null {
        return $this->documentoDao->get($id);
    }

    public function listAll(Request $request): array | null {
        $data = $request->all();
        $documentos = $this->documentoDao->list((isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
        return (!empty($documentos)) ? $documentos : throw new Exception("Os documentos não foram encontrados. Verifique as informações e tente novamente mais tarde.");
    }

    public function findAll(Request $request): array | null {
        $data = $request->all();
        $documentos = $this->documentoDao->find($data["q"], (isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
        return (!empty($documentos)) ? $documentos : throw new Exception("Os documentos não foram encontrados. Verifique as informações e tente novamente mais tarde.");
    }

    public function countRows(): int {
        return $this->documentoDao->count();
    }

    public function countSearchLines(Request $request): int {
        $data = $request->all();
        return $this->documentoDao->countFind($data["q"]);
    }
}
