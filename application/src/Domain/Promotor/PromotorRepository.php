<?php declare(strict_types=1);

namespace App\Domain\Promotor;

interface PromotorRepository
{
    public function save(Promotor $promotor): void;
    public function obtainById(string $promotorId): ?Promotor;
}