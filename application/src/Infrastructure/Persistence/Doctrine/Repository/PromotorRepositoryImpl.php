<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Promotor\Promotor;
use App\Domain\Promotor\PromotorRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class PromotorRepositoryImpl extends ServiceEntityRepository implements PromotorRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promotor::class);
    }

    public function save(Promotor $promotor): void
    {
        $this->_em->persist($promotor);
        $this->_em->flush($promotor);
    }

    public function obtainById(string $promotorId): ?Promotor
    {
        return $this->find($promotorId);
    }
}