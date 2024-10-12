<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Ramsey\Uuid\UuidInterface;
use TypeError;

use function array_merge;
use function array_unique;
use function method_exists;

abstract class SnelstartObject extends BaseObject
{
    /**
     * De publieke sleutel (public identifier, als uuid) dat uniek een object identificeert.
     */
    protected UuidInterface|null $id = null;

    /**
     * Geeft de realtieve uri terug van het object waartoe de identifier behoort.
     */
    protected string $uri;

    final public function __construct()
    {
    }

    public static array $editableAttributes = ['id'];

    public function getId(): UuidInterface|null
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUri(): string|null
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    public static function getEditableAttributes(): array
    {
        return array_unique(array_merge(static::$editableAttributes, self::$editableAttributes));
    }

    /**
     * Check if one or more of the editable properties are not null. It is usually a good indicator if an entity
     * has been properly hydrated.
     */
    public function isHydrated(): bool
    {
        $hydrated = false;

        foreach (static::getEditableAttributes() as $editableAttribute) {
            try {
                /** @psalm-suppress RedundantCondition */
                if ($editableAttribute !== "id" && $editableAttribute !== "url" && ! $hydrated) {
                    $possibleMethodNames = ["get{$editableAttribute}", $editableAttribute];

                    foreach ($possibleMethodNames as $possibleMethodName) {
                        if (
                            method_exists($this, $possibleMethodName) &&
                            ($hydrated = $this->{$possibleMethodName}() !== null)
                        ) {
                            return true;
                        }
                    }
                }
            } catch (TypeError) {
            }
        }

        return $hydrated;
    }

    /**
     * Create an object with the given UUID (handy if you already stored the UUID somewhere).
     *
     * @return static
     */
    public static function createFromUUID(UuidInterface $uuid): self
    {
        return (new static())->setId($uuid);
    }
}