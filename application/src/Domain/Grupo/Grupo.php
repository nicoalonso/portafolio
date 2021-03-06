<?php declare(strict_types=1);

namespace App\Domain\Grupo;

class Grupo
{
    private GrupoId $id;
    private string $nombre;
    private int $cache;
    private string $email;

    public function __construct(string $nombre, int $cache, string $email = '')
    {
        $this->id = GrupoId::generate();
        $this->nombre = $nombre;
        $this->cache = $cache;
        $this->email = $email;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function cache(): int
    {
        return $this->cache;
    }

    public function email(): string
    {
        return $this->email;
    }
}