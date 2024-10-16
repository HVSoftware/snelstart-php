<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 *
 * I know.. A lot of boilerplate but we can change this in the near future.
 */

namespace SnelstartPHP\Secure;

use ArrayIterator;
use Iterator;
use IteratorAggregate;

final class ApiSubscriptionKey implements IteratorAggregate
{
    /** @var array */
    private array $keys = [];

    public function __construct(string $primaryKey, string $secondaryKey)
    {
        $this->keys[] = $primaryKey;
        $this->keys[] = $secondaryKey;
    }

    public function getPrimary(): string
    {
        return $this->keys[0];
    }

    public function getSecondary(): string
    {
        return $this->keys[1];
    }

    public function getKeys(): array
    {
        return $this->keys;
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->getKeys());
    }
}