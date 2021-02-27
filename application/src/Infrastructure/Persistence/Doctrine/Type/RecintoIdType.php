<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Recinto\RecintoId;

final class RecintoIdType extends UuidType
{
    protected function typeName() : string
    {
        return 'recintoId';
    }

    protected function typeClassName() : string
    {
        return RecintoId::class;
    }
}