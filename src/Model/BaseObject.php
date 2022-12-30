<?php

declare(strict_types=1);

namespace SnelstartPHP\Model;

use function array_unique;
use function array_merge;

abstract class BaseObject
{
    /**
     * @var string[]
     */
    public static array $editableAttributes = [];

    public static function getEditableAttributes(): array
    {
        return array_unique(array_merge(self::$editableAttributes, static::$editableAttributes));
    }
}