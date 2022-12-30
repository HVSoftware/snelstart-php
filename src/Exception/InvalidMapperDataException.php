<?php

declare(strict_types=1);

namespace SnelstartPHP\Exception;

use LogicException;
use function implode;
use function sprintf;

final class InvalidMapperDataException extends LogicException
{
    public static function mandatoryKeysAreMissing(string ...$keys): self
    {
        throw new self(sprintf("The following mandatory keys were missing: %s", implode(",", $keys)));
    }
}