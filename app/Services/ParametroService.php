<?php

namespace App\Services;

use App\Database\DAO\MySQL\ParametroDAO;
use App\Database\DAO\MySQL\DadoDocumentoDAO;
use App\Database\DAO\MySQL\DocumentoUsuarioDAO;
use App\Models\Parametro;
use App\Services\Service;
use Exception;
use Illuminate\Http\Request;

class ParametroService implements Service {

    public ParametroDAO $parametroDao;

    public function __construct() {
        $this->parametroDao = new ParametroDAO();
    }

    public function create(Request $request): int {
        $data = $request->all();
        return $this->parametroDao->insert(new Parametro(null, $data["titulo"], $data["tipo"], $data["regex"]));
    }

    public function update(Request $request): bool {
        $data = $request->all();
        return $this->parametroDao->change(new Parametro($data["id"], $data["titulo"], $data["tipo"], $data["regex"]));
    }

    public function delete(Request $request): int {
        $data = $request->all();
        $dadoDocumentoDao = new DadoDocumentoDAO();
        $documentoUsuarioDao = new DocumentoUsuarioDAO();
        $dados = $dadoDocumentoDao->getAllByParameterId($data["id"]);

        if (!empty($dados)) {
            foreach ($dados as $dado) {
                $documentoUsuarioDao->deleteAllByDataId($dado->id);
            }
        }

        $dadoDocumentoDao->deleteAllByDocumentId($data["id"]);

        return $this->parametroDao->delete($data["id"]);
    }

    public function get(Request $request): object | null {
        $data = $request->all();
        return $this->parametroDao->get((isset($data["id"]) && !empty($data["id"])) ? $data["id"] : 0);
    }

    public function parameter(int $id): Parametro | null {
        return $this->parametroDao->get($id);
    }

    public function listAll(Request $request): array | null {
        $data = $request->all();
        return $this->parametroDao->list((isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function findAll(Request $request): array | null {
        $data = $request->all();
        return $this->parametroDao->find($data["q"], (isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function countRows(): int {
        return $this->parametroDao->count();
    }

    public function countSearchLines(Request $request): int {
        $data = $request->all();
        return $this->parametroDao->countFind($data["q"]);
    }
}
