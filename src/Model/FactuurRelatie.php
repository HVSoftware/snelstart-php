<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Ramsey\Uuid\UuidInterface;

final class FactuurRelatie extends BaseObject
{
    /**
     * De publieke sleutel (public identifier, als uuid) dat uniek een object identificeert.
     */
    private UuidInterface $id;

    /**
     * Geeft de relatieve uri terug van het object waartoe de identifier behoort.
     */
    private string $uri;

    public static array $editableAttributes = ['id'];

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): FactuurRelatie
    {
        $this->id = $id;

        return $this;
    }

    public function getUri(): string|null
    {
        return $this->uri;
    }

    public function setUri(string $uri): FactuurRelatie
    {
        $this->uri = $uri;

        return $this;
    }
}