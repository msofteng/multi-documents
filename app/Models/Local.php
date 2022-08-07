<?php

namespace App\Models;

class Local
{
    private $nome;
    private $latitude;
    private $longitude;

    public function __construct(string $nome = null, float $latitude = null, float $longitude = null) {
        $this->nome = $nome;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

	public function getNome(): string {
		return $this->nome;
	}

	public function setNome(string $nome): void {
		$this->nome = $nome;
	}

	public function getLatitude(): float {
		return $this->latitude;
	}

	public function setLatitude(float $latitude): void {
		$this->latitude = $latitude;
	}

	public function getLongitude(): float {
		return $this->longitude;
	}

	public function setLongitude(float $longitude): void {
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
