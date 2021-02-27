<?php

namespace App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository;

use App\Domain\Concierto\Concierto;
use App\Domain\Concierto\ConciertoRepository;


class ConciertoRepositoryStub implements ConciertoRepository
{
    public function save(Concierto $concierto): void
    {
        
    }
}