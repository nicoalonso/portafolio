<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\MedioPublicitario\MedioPublicitario;
use App\Domain\MedioPublicitario\MedioPublicitarioRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MedioPublicitarioRepositoryImpl extends ServiceEntityRepository implements MedioPublicitarioRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedioPublicitario::class);
    }

    public function save(MedioPublicitario $medio): void
    {
        $this->_em->persist($medio);
        $this->_em->flush($medio);
    }

    public function obtainById(string $medioId): ?MedioPublicitario
    {
        return $this->find($medioId);
    }
}