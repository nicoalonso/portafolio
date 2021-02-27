<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Promotor\PromotorId;

final class PromotorIdType extends UuidType
{
    protected function typeName() : string
    {
        return 'promotorId';
    }

    protected function typeClassName() : string
    {
        return PromotorId::class;
    }
}