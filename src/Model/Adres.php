<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

final class Adres extends BaseObject
{
    /**
     * De volledige naam van de contactpersoon op dit adres.
     */
    protected string|null $contactpersoon = null;

    /**
     * De straatnaam (inclusief huisnummer).
     */
    protected string|null $straat = null;

    /**
     * De postcode van het adres.
     */
    protected string|null $postcode = null;

    /**
     * De plaatsnaam van het adres.
     */
    protected string|null $plaats = null;

    /**
     * De Id van het land waartoe dit adres behoord.
     * Indien niets is opgegeven is dit standaard "Nederland".
     */
    protected Land|null $land = null;

    /**
     * @var string[]
     */
    public static array $editableAttributes = [
        "contactpersoon",
        "straat",
        "postcode",
        "plaats",
        "land",
    ];

    public function getContactpersoon(): string|null
    {
        return $this->contactpersoon;
    }

    public function setContactpersoon(string|null $contactpersoon): self
    {
        $this->contactpersoon = $contactpersoon;

        return $this;
    }

    public function getStraat(): string|null
    {
        return $this->straat;
    }

    public function setStraat(string|null $straat): self
    {
        $this->straat = $straat;

        return $this;
    }

    public function getPostcode(): string|null
    {
        return $this->postcode;
    }

    public function setPostcode(string|null $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getPlaats(): string|null
    {
        return $this->plaats;
    }

    public function setPlaats(string|null $plaats): self
    {
        $this->plaats = $plaats;

        return $this;
    }

    public function getLand(): Land|null
    {
        return $this->land;
    }

    public function setLand(Land|null $land): self
    {
        $this->land = $land;

        return $this;
    }
}