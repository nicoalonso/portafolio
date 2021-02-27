<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Concierto\ConciertoId;

final class ConciertoIdType extends UuidType
{
    protected function typeName() : string
    {
        return 'conciertoIdType';
    }

    protected function typeClassName() : string
    {
        return ConciertoId::class;
    }
}