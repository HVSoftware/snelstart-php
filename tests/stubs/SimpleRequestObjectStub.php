<?php

namespace SnelstartPHP\Tests\stubs;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\BaseObject;

class SimpleRequestObjectStub extends BaseObject
{
    private string $simpleValue = "test";
    private ?string $nullValue = null;
    private int $integerValue = 1;
    private bool $booleanValue = false;
    private $id;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSimpleValue(): string
    {
        return $this->simpleValue;
    }

    public function getNullValue(): ?string
    {
        return $this->nullValue;
    }

    public function getIntegerValue(): int
    {
        return $this->integerValue;
    }

    public function getBooleanValue(): bool
    {
        return $this->booleanValue;
    }
}