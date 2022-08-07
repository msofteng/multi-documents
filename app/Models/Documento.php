<?php

namespace App\Models;

class Documento
{
    public $id;
    public $nome;
    public $pais;
    public $descricao;
    /** @var Parametro[] */
    public array $parametros;

    public function __construct(int $id = null, string $nome = null, string $pais = null, string $descricao = null, array $parametros = array()) {
        $this->id = $id;
        $this->nome = $nome;
        $this->pais = $pais;
        $this->descricao = $descricao;
        $this->parametros = $parametros;
    }

    public function toString(): string {
		return '
            {
                "id": ' . $this->id . ',
                "nome": "' . $this->nome . '",
                "pais": "' . $this->pais . '",
                "descricao": "' . $this->descricao . '",
                "parametros": ' . json_encode($this->parametros) . '
            }
        ';
	}
}
