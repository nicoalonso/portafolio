<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Grupo\GrupoId;

final class GrupoIdType extends UuidType
{
    protected function typeName() : string
    {
        return 'grupoId';
    }

    protected function typeClassName() : string
    {
        return GrupoId::class;
    }
}