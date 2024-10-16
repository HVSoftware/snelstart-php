<?php

declare(strict_types=1);

namespace SnelstartPHP\Serializer;

use DateTimeInterface;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

interface RequestSerializerInterface
{
    public function uuidInterfaceToString(UuidInterface $uuid): string;

    public function dateTimeToString(DateTimeInterface $dateTime): string;

    public function moneyFormatToString(Money $money): string;

    /**
     * @psalm-param  T $value
     *
     * @psalm-return T
     *
     * @template     T
     */
    public function scalarValue($value);

    public function arrayValue(array $value): array;
}