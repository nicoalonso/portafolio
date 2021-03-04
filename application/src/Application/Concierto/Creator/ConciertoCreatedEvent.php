<?php declare(strict_types=1);

namespace App\Application\Concierto\Creator;

use App\Domain\Bus\DomainEvent;
use App\Domain\Concierto\Concierto;

final class ConciertoCreatedEvent implements DomainEvent
{
    private Concierto $concierto;

    public function __construct(Concierto $concierto)
    {
        $this->concierto = $concierto;
    }

    public function concierto(): Concierto
    {
        return $this->concierto;
    }
}