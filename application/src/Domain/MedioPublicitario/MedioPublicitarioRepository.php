<?php declare(strict_types=1);

namespace App\Domain\MedioPublicitario;

interface MedioPublicitarioRepository
{
    public function save(MedioPublicitario $medio): void;
    public function obtainById(string $medioId): ?MedioPublicitario;
}