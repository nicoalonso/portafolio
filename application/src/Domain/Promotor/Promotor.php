<?php declare(strict_types=1);

namespace App\Domain\Promotor;

class Promotor
{
    private PromotorId $id;
    private string $nombre;

    public function __construct(string $nombre)
    {
        $this->id = PromotorId::generate();
        $this->nombre = $nombre;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }
}