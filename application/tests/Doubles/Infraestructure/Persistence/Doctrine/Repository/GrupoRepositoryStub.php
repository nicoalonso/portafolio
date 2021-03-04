<?php

namespace App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository;

use App\Domain\Grupo\Grupo;
use App\Domain\Grupo\GrupoRepository;

class GrupoRepositoryStub implements GrupoRepository
{
    /** @var Grupo[] */
    public array $grupoById = [];

    public function save(Grupo $grupo): void
    {

    }

    public function obtainById(string $grupoId): ?Grupo
    {
        if (!array_key_exists($grupoId, $this->grupoById)) {
            return null;
        }

        return $this->grupoById[$grupoId];
    }
}