<?php

namespace App\Services;

use App\Database\MySQL\UsuarioDAO;
use App\Models\Local;
use App\Models\Usuario;
use App\Services\Service;

use Illuminate\Http\Request;

class UsuarioService implements Service {

    public UsuarioDAO $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
    }

    public function create(Request $request): int {
        $data = $request->all();
        return $this->usuarioDao->insert(new Usuario(null, $data["nome"], $data["user"], $data["senha"], new Local($data["local"]["nome"], $data["local"]["latitude"], $data["local"]["longitude"]), $data["token"]));
    }

    public function update(Request $request): bool {
        $data = $request->all();
        return $this->usuarioDao->change(new Usuario($data["id"], $data["nome"], $data["user"], $data["senha"], new Local($data["local"]["nome"], $data["local"]["latitude"], $data["local"]["longitude"]), $data["token"]));
    }

    public function delete(Request $request): int {
        $data = $request->all();
        return $this->usuarioDao->delete($data["id"]);
    }

    public function get(Request $request): object | null {
        $data = $request->all();
        return $this->usuarioDao->get((isset($data["id"]) && !empty($data["id"])) ? $data["id"] : 0);
    }

    public function listAll(Request $request): array | null {
        $data = $request->all();
        return $this->usuarioDao->list((isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function findAll(Request $request): array | null {
        $data = $request->all();
        return $this->usuarioDao->find($data["q"], (isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
    }

    public function countRows(): int {
        return $this->usuarioDao->count();
    }

    public function countSearchLines(Request $request): int {
        $data = $request->all();
        return $this->usuarioDao->countFind($data["q"]);
    }
}
