<?php declare(strict_types=1);

namespace App\Domain\Promotor;

class Promotor
{
    private PromotorId $id;
    private string $nombre;
    private string $emailAddress;

    public function __construct(string $nombre, string $emailAddress)
    {
        $this->id = PromotorId::generate();
        $this->nombre = $nombre;
        $this->emailAddress = $emailAddress;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function email(): string
    {
        return $this->emailAddress;
    }
}