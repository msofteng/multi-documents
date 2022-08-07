<?php

namespace App\Models;

class Parametro
{
    public $id;
    public $titulo;
    public $tipo;
    public $regex;
    public $valor; // null

    public function __construct(string $id = null, string $titulo = null, string $tipo = null, string $regex = null, string $valor = null) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->tipo = $tipo;
        $this->regex = $regex;
        $this->valor = $valor;
    }

    public function toString(): string {
		return '
            {
                "id": ' . $this->id . ',
                "titulo": "' . $this->titulo . '",
                "tipo": "' . $this->tipo . '",
                "regex": "' . $this->regex . '",
                "valor": "' . $this->regex . '"
            }
        ';
	}
}
