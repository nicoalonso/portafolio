<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Grupo\Grupo;
use App\Domain\Grupo\GrupoRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class GrupoRepositoryImpl extends ServiceEntityRepository implements GrupoRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grupo::class);
    }

    public function save(Grupo $grupo): void
    {
        $this->_em->persist($grupo);
        $this->_em->flush($grupo);
    }

    public function obtainById(string $grupoId): ?Grupo
    {
        return $this->find($grupoId);
    }
}