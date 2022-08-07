<?php

namespace App\Models;

class Parametro
{
    private $titulo;
    private $valor;

    public function __construct(string $titulo = null, string $valor = null) {
        $this->titulo = $titulo;
        $this->valor = $valor;
    }

	public function getTitulo(): string {
		return $this->titulo;
	}

	public function setTitulo(string $titulo): void {
		$this->titulo = $titulo;
	}

	public function getValor(): string {
		return $this->valor;
	}

	public function setValor(string $valor): void {
		$this->valor = $valor;
	}
}
