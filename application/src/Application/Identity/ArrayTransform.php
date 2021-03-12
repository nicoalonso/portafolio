<?php declare(strict_types=1);

namespace App\Application\Identity;

use DateTime;

final class ArrayTransform
{
    private const DEFAULT_DATE_FORMAT = 'Y-m-d H:i:s';

    /** @var array */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function toString(string $keyName, ?string $default = null): string
    {
        return (string) $this->get($keyName, $default);
    }

    public function toInt(string $keyName, ?int $default = null): int
    {
        return (int) $this->get($keyName, $default);
    }

    public function toFloat(string $keyName, ?float $default = null): float
    {
        return (float) $this->get($keyName, $default);
    }

    public function toBool(string $keyName, ?bool $default = null): bool
    {
        return (bool) $this->get($keyName, $default);
    }

    public function toArray(string $keyName, ?array $default = null): array
    {
        return (array) $this->get($keyName, $default);
    }

    public function toDate(string $keyName, ?string $format = null, ?DateTime $default = null): ?DateTime
    {
        $dateValue = $this->get($keyName);
        if (!is_string($dateValue)) {
            return $default;
        }
        if (null === $format) {
            $format = self::DEFAULT_DATE_FORMAT;
        }
        $date = DateTime::createFromFormat($format, $dateValue);
        if (false === $date) {
            return $default;
        }
        return $date;
    }

    /**
     * @param  mixed|null $default = null
     * @return mixed|null
     */
    private function get(string $keyName, $default = null)
    {
        if (!array_key_exists($keyName, $this->data)) {
            return $default;
        }
        return $this->data[$keyName];
    }
}