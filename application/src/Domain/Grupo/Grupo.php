<?php declare(strict_types=1);

namespace App\Domain\Grupo;

class Grupo
{
    private GrupoId $id;
    private string $nombre;
    private int $cache;

    public function __construct(string $nombre, int $cache)
    {
        $this->id = GrupoId::generate();
        $this->nombre = $nombre;
        $this->cache = $cache;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function cache(): int
    {
        return $this->cache;
    }
}