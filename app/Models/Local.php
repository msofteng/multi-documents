<?php

namespace App\Models;

class Local
{
    public $nome;
    public $latitude;
    public $longitude;

    public function __construct(string $nome = null, float $latitude = null, float $longitude = null) {
        $this->nome = $nome;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function toString(): string {
		return '
            {
                "nome": "' . $this->nome . '",
                "localizacao": {
                    "latitude": ' . $this->latitude . ',
                    "longitude": ' . $this->longitude . '
                }
            }
        ';
	}
}
