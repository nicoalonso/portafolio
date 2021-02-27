<?php declare(strict_types=1);

namespace App\Domain\Recinto;

class Recinto
{
    private RecintoId $id;
    private string $nombre;
    private int $costeAlquiler;
    private int $precioEntrada;

    public function __construct(string $nombre, int $costeAlquiler, int $precioEntrada)
    {
        $this->id = RecintoId::generate();
        $this->nombre = $nombre;
        $this->costeAlquiler = $costeAlquiler;
        $this->precioEntrada = $precioEntrada;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function costeAlquiler(): int
    {
        return $this->costeAlquiler;
    }

    public function precioEntrada(): int
    {
        return $this->precioEntrada;
    }
}