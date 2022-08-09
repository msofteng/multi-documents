<?php

namespace App\Services;

use App\Database\DAO\MySQL\DAOUtil;
use App\Database\DAO\MySQL\DocumentoUsuarioDAO;
use App\Database\DAO\MySQL\UsuarioDAO;
use App\Models\Local;
use App\Models\Usuario;
use App\Services\Service;
use Exception;
use Illuminate\Http\Request;

class UsuarioService implements Service {

    public UsuarioDAO $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
    }

    public function create(Request $request): int {
        $data = $request->all();
        $exists = DAOUtil::isUsuario($data["user"]);
        return (!$exists) ? $this->usuarioDao->insert(new Usuario(null, $data["nome"], $data["user"], $data["senha"], new Local($data["local"]["nome"], $data["local"]["localizacao"]["latitude"], $data["local"]["localizacao"]["longitude"]), $data["token"])) : throw new Exception("O usuário já foi cadastrado", 1062);
    }

    public function update(Request $request): bool {
        $data = $request->all();
        $bool = $this->usuarioDao->change(new Usuario($data["id"], $data["nome"], $data["user"], $data["senha"], new Local($data["local"]["nome"], $data["local"]["localizacao"]["latitude"], $data["local"]["localizacao"]["longitude"]), $data["token"]));
        return ($bool) ? $bool : throw new Exception("ERRO!");
    }

    public function delete(Request $request): int {
        $data = $request->all();
        (new DocumentoUsuarioDAO())->deleteAllByUserId($data["id"]);
        $rows = $this->usuarioDao->delete($data["id"]);
        return ($rows > 0) ? $rows : throw new Exception("O usuário não foi encontrado");
    }

    public function get(Request $request): object | null {
        $data = $request->all();
        $usuario = $this->usuarioDao->get((isset($data["id"]) && !empty($data["id"])) ? $data["id"] : 0);
        return (!empty($usuario)) ? $usuario : throw new Exception("O usuário não foi encontrado");
    }

    public function user($id): Usuario | null {
        return $this->usuarioDao->get($id);
    }

    public function listAll(Request $request): array | null {
        $data = $request->all();
        $usuarios = $this->usuarioDao->list((isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
        return (!empty($usuarios)) ? $usuarios : throw new Exception("Os usuários não foram encontrados. Verifique as informações e tente novamente mais tarde.");
    }

    public function findAll(Request $request): array | null {
        $data = $request->all();
        $usuarios = $this->usuarioDao->find($data["q"], (isset($data["coluna"])) ? $data["coluna"] : null, (isset($data["ordem"])) ? $data["ordem"] : null, (isset($data["limit"])) ? $data["limit"] : null, (isset($data["offset"])) ? $data["offset"] : null);
        return (!empty($usuarios)) ? $usuarios : throw new Exception("Os usuários não foram encontrados. Verifique as informações e tente novamente mais tarde.");
    }

    public function countRows(): int {
        return $this->usuarioDao->count();
    }

    public function countSearchLines(Request $request): int {
        $data = $request->all();
        return $this->usuarioDao->countFind($data["q"]);
    }
}
