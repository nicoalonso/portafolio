<?php

namespace App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository;

use App\Domain\Recinto\Recinto;
use App\Domain\Recinto\RecintoRepository;

class RecintoRepositoryStub implements RecintoRepository
{
    public ?Recinto $recintoReturn = null;

    public function save(Recinto $recinto): void
    {

    }

    public function obtainById(string $recintoId): ?Recinto
    {
        return $this->recintoReturn;
    }
}