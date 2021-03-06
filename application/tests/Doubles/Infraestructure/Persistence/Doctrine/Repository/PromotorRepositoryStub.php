<?php

namespace App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository;

use App\Domain\Promotor\Promotor;
use App\Domain\Promotor\PromotorRepository;


class PromotorRepositoryStub implements PromotorRepository
{
    public ?Promotor $promotorReturn = null;

    public function save(Promotor $promotor): void
    {

    }

    public function obtainById(string $promotorId): ?Promotor
    {
        return $this->promotorReturn;
    }
}