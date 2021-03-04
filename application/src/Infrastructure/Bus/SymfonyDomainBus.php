<?php declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Bus\DomainBus;
use App\Domain\Bus\DomainEvent;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyDomainBus implements DomainBus
{
    private MessageBusInterface $domainBus;

    public function __construct(MessageBusInterface $domainBus)
    {
        $this->domainBus = $domainBus;
    }

    public function dispatch(DomainEvent $event): void
    {
        $this->domainBus->dispatch($event);
    }
}