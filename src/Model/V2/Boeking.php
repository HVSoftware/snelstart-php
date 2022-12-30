<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use DateTimeInterface;
use Money\Money;
use SnelstartPHP\Model\SnelstartObject;

abstract class Boeking extends SnelstartObject
{
    /**
     * Het tijdstip waarop het grootboek is aangemaakt of voor het laatst is gewijzigd
     */
    protected DateTimeInterface|null $modifiedOn = null;

    /**
     * Het boekstuknummer van de boeking.
     */
    protected string|null $boekstuk = null;

    /**
     * Geeft aan of deze boeking is aangepast door de accountant.
     */
    protected bool $gewijzigdDoorAccountant = false;

    /**
     * Deze boeking verdient speciale aandacht, in SnelStart wordt dit visueel benadrukt.
     */
    protected bool $markering = false;

    /**
     * De datum van de factuur, dit is ook de datum waarop de boeking wordt geboekt.
     */
    protected DateTimeInterface|null $factuurDatum = null;

    /**
     * Het tijdstip waarop de factuur is of zal vervallen
     */
    protected DateTimeInterface|null $vervalDatum = null;

    /**
     * De factuurnummer van de boeking.
     */
    protected string $factuurnummer;

    /**
     * De omschrijving van de boeking.
     */
    protected string|null $omschrijving = null;

    protected Money $factuurbedrag;

    /**
     * De omzetregels van de boeking. De btw-bedragen staan hier niet in,
     * deze staan in de Btw-collectie.
     *
     * @see Boekingsregel
     *
     * @var Boekingsregel[]
     */
    protected array $boekingsregels = [];

    /**
     * De af te dragen btw van de boeking per btw-tarief
     *
     * @see Btwregel
     *
     * @var Btwregel[]|null
     */
    protected array|null $btw = null;

    /** @var Document[] */
    protected array $documents = [];

    /** @var string[] */
    public static array $editableAttributes = [
        "id",
        "boekstuk",
        "gewijzigdDoorAccountant",
        "markering",
        "factuurDatum",
        "factuurnummer",
        "omschrijving",
        "factuurBedrag",
        "boekingsregels",
        "vervalDatum",
        "btw",
        "documents",
    ];

    public function getModifiedOn(): DateTimeInterface|null
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(DateTimeInterface|null $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getBoekstuk(): string|null
    {
        return $this->boekstuk;
    }

    public function setBoekstuk(string|null $boekstuk): self
    {
        $this->boekstuk = $boekstuk;

        return $this;
    }

    public function isGewijzigdDoorAccountant(): bool
    {
        return $this->gewijzigdDoorAccountant;
    }

    public function setGewijzigdDoorAccountant(bool $gewijzigdDoorAccountant): self
    {
        $this->gewijzigdDoorAccountant = $gewijzigdDoorAccountant;

        return $this;
    }

    public function isMarkering(): bool
    {
        return $this->markering;
    }

    public function setMarkering(bool $markering): self
    {
        $this->markering = $markering;

        return $this;
    }

    public function getFactuurdatum(): DateTimeInterface|null
    {
        return $this->factuurDatum;
    }

    public function setFactuurdatum(DateTimeInterface|null $factuurDatum): self
    {
        $this->factuurDatum = $factuurDatum;

        return $this;
    }

    public function getVervaldatum(): DateTimeInterface|null
    {
        return $this->vervalDatum;
    }

    public function setVervaldatum(DateTimeInterface|null $vervalDatum): self
    {
        $this->vervalDatum = $vervalDatum;

        return $this;
    }

    public function getFactuurnummer(): string
    {
        return $this->factuurnummer;
    }

    public function setFactuurnummer(string $factuurnummer): self
    {
        $this->factuurnummer = $factuurnummer;

        return $this;
    }

    public function getOmschrijving(): string|null
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string|null $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getFactuurbedrag(): Money
    {
        return $this->factuurbedrag;
    }

    public function setFactuurbedrag(Money $factuurbedrag): self
    {
        $this->factuurbedrag = $factuurbedrag;

        return $this;
    }

    public function getBoekingsregels(): array
    {
        return $this->boekingsregels;
    }

    public function setBoekingsregels(Boekingsregel ...$boekingsregels): self
    {
        $this->boekingsregels = $boekingsregels;

        return $this;
    }

    public function getBtw(): array
    {
        return $this->btw ?? [];
    }

    public function setBtw(Btwregel ...$btw): self
    {
        $this->btw = $btw;

        return $this;
    }

    public function getDocuments(): array
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        $this->documents[] = $document;

        return $this;
    }
}
