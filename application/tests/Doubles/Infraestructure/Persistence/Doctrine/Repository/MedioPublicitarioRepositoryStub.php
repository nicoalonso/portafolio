<?php

namespace App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository;

use App\Domain\MedioPublicitario\MedioPublicitario;
use App\Domain\MedioPublicitario\MedioPublicitarioRepository;


class MedioPublicitarioRepositoryStub implements MedioPublicitarioRepository
{
    public function save(MedioPublicitario $medio): void
    {

    }

    public function obtainById(string $medioId): ?MedioPublicitario
    {
        return null;
    }
}