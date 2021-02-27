<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\MedioPublicitario\MedioPublicitarioId;

final class MedioPublicitarioIdType extends UuidType
{
    protected function typeName() : string
    {
        return 'medioPublicitarioId';
    }

    protected function typeClassName() : string
    {
        return MedioPublicitarioId::class;
    }
}