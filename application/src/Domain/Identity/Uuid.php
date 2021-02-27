<?php declare(strict_types=1);

namespace App\Domain\Identity;

use Ramsey\Uuid\Uuid as RamseyUuid;
use DomainException;

abstract class Uuid
{
    private const UUID_VERSION = 4;

    protected string $value;

    public function __construct(string $value)
    {
        $this->isValidUuidOrFail($value);
        $this->value = $value;
    }

    private function isValidUuidOrFail(string $value) : void
    {
        if (!RamseyUuid::isValid($value) || self::UUID_VERSION !== RamseyUuid::fromString($value)->getFields()->getVersion()) {
            throw new DomainException($value ." is not a valid type of ". static::class);
        }
    }

    public static function generate() : self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public function __toString()
    {
        return $this->value;
    }

    public function value() : string
    {
        return $this->value;
    }
}