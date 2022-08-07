<?php

namespace App\Models;

class Documento
{
    private $id;
    private $nome;
    private $pais;
    private $descricao;
    /** @var Parametro[] $parametros */
    private array $parametros;

    public function __construct(int $id = null, string $nome = null, string $pais = null, string $descricao = null, array $parametros = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->pais = $pais;
        $this->descricao = $descricao;
        $this->parametros = $parametros;
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

	public function getPais(): string {
		return $this->pais;
	}

	public function setPais(string $pais): void {
		$this->pais = $pais;
	}

	public function getDescricao(): string {
		return $this->descricao;
	}

	public function setDescricao(string $descricao): void {
		$this->descricao = $descricao;
	}

    /** @return Parametro[] */

	public function getParametros() {
		return $this->parametros;
	}

    /** @param Parametro[] */

	public function setParametros(array $parametros): void {
		$this->parametros = $parametros;
	}
}
