<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Recinto\Recinto;
use App\Domain\Recinto\RecintoRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class RecintoRepositoryImpl extends ServiceEntityRepository implements RecintoRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recinto::class);
    }

    public function save(Recinto $recinto): void
    {
        $this->_em->persist($recinto);
        $this->_em->flush($recinto);
    }

    public function obtainById(string $recintoId): ?Recinto
    {
        return $this->find($recintoId);
    }
}