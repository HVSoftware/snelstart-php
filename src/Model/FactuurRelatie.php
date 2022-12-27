<?php
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
     * Geeft de realtieve uri terug van het object waartoe de identifier behoort.
     */
    private string $uri;

    public static $editableAttributes = [ 'id'];

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): FactuurRelatie
    {
        $this->id = $id;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): FactuurRelatie
    {
        $this->uri = $uri;

        return $this;
    }
}