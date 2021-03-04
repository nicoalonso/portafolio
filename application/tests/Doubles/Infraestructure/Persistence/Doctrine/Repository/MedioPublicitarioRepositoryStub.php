<?php

namespace App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository;

use App\Domain\MedioPublicitario\MedioPublicitario;
use App\Domain\MedioPublicitario\MedioPublicitarioRepository;


class MedioPublicitarioRepositoryStub implements MedioPublicitarioRepository
{
    /** @var MedioPublicitario[] */
    public array $medioById = [];

    public function save(MedioPublicitario $medio): void
    {

    }

    public function obtainById(string $medioId): ?MedioPublicitario
    {
        if (!array_key_exists($medioId, $this->medioById)) {
            return null;
        }
        return $this->medioById[$medioId];
    }
}