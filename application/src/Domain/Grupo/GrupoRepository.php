<?php declare(strict_types=1);

namespace App\Domain\Grupo;

interface GrupoRepository
{
    public function save(Grupo $grupo): void;
    public function obtainById(string $grupoId): ?Grupo;
}