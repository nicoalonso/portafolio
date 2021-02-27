<?php declare(strict_types=1);

namespace App\Domain\Recinto;

interface RecintoRepository
{
    public function save(Recinto $recinto): void;
    public function obtainById(string $recintoId): ?Recinto;
}