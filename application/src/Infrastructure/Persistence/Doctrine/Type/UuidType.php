<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

abstract class UuidType extends StringType
{
    abstract protected function typeName() : string;
    abstract protected function typeClassName() : string;

    public function getName()
    {
        return $this->typeName();
    }

    /**
     * @param  string  $value
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $className = $this->typeClassName();
        return new $className($value);
    }

    /**
     * @param  Uuid  $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}