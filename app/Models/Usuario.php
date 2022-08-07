<?php

namespace App\Models;

class Usuario
{
    public $id;
    public $nome;
    public $user;
    private $senha;
    public Local $local;
    private $token;

    public function __construct(int $id = null, string $nome = null, string $user = null, string $senha = null, Local $local = new Local(), string $token = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->user = $user;
        $this->senha = $senha;
        $this->local = $local;
        $this->token = $token;
    }

    public function toString(): string {
		return '
            {
                "id": ' . $this->id . ',
                "nome": "' . $this->nome . '",
                "user": "' . $this->user . '",
                "senha": "' . $this->senha . '",
                "local": ' . $this->local->toString() . ',
                "token": "' . $this->token . '"
            }
        ';
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($senha): void {
		$this->senha = $senha;
	}

	public function getToken() {
		return $this->token;
	}

	public function setToken($token): void {
		$this->token = $token;
	}
}
