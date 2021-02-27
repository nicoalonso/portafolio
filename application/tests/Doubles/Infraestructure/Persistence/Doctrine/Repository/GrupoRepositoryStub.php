<?php

namespace App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository;

use App\Domain\Grupo\Grupo;
use App\Domain\Grupo\GrupoRepository;

class GrupoRepositoryStub implements GrupoRepository
{
    public function save(Grupo $grupo): void
    {

    }

    public function obtainById(string $grupoId): ?Grupo
    {

    }
}