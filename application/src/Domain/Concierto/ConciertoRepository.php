<?php declare(strict_types=1);

namespace App\Domain\Concierto;

interface ConciertoRepository
{
    public function save(Concierto $concierto): void;
}