<?php

namespace App\Models;

class Usuario
{
    private $id;
    private $nome;
    private $user;
    private $senha;
    private Local $local;
    private $token;

    public function __construct(int $id = null, string $nome = null, string $user = null, string $senha = null, Local $local = new Local(), string $token = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->user = $user;
        $this->senha = $senha;
        $this->local = $local;
        $this->token = $token;
    }

	public function getId(): int {
		return $this->id;
	}

	public function setId(int $id): void {
		$this->id = $id;
	}

	public function getNome(): string {
		return $this->nome;
	}

	public function setNome(string $nome): void {
		$this->nome = $nome;
	}

	public function getUser(): string {
		return $this->user;
	}

	public function setUser(string $user): void {
		$this->user = $user;
	}

	public function getSenha(): string {
		return $this->senha;
	}

	public function setSenha(string $senha): void {
		$this->senha = $senha;
	}

    public function getLocal(): Local {
		return $this->local;
	}

	public function setLocal(Local $local): void {
		$this->local = $local;
	}

	public function getToken(): string {
		return $this->token;
	}

	public function setToken(string $token): void {
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
}
