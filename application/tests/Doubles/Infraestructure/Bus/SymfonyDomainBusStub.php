<?php declare(strict_types=1);

namespace App\Tests\Doubles\Infraestructure\Bus;

use App\Domain\Bus\DomainBus;
use App\Domain\Bus\DomainEvent;

class SymfonyDomainBusStub implements DomainBus
{
    public DomainEvent $domainEvent;

    public function dispatch(DomainEvent $event): void
    {
        $this->domainEvent = $event;
    }
}