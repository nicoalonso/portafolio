<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Concierto\Concierto;
use App\Domain\Concierto\ConciertoRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ConciertoRepositoryImpl extends ServiceEntityRepository implements ConciertoRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Concierto::class);
    }

    public function save(Concierto $concierto): void
    {
        $this->_em->persist($concierto);
        $this->_em->flush($concierto);
    }
}