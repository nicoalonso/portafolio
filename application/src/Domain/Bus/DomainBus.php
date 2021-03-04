<?php declare(strict_types=1);

namespace App\Domain\Bus;

interface DomainBus
{
    public function dispatch(DomainEvent $event): void;
}