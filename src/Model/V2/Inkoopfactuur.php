<?php

declare(strict_types=1);

namespace SnelstartPHP\Model\V2;

use DateTimeImmutable;
use Money\Money;
use SnelstartPHP\Model\SnelstartObject;

final class Inkoopfactuur extends SnelstartObject
{
    /**
     * De inkoopboeking bij de factuur
     */
    private Inkoopboeking|null $inkoopBoeking = null;

    /**
     * Het tijdstip waarop de inkoopfactuur voor het laatst is gewijzigd.
     */
    private DateTimeImmutable|null $modifiedOn = null;

    /**
     * Het openstaand saldo van de inkoopfactuur. Deze wordt alleen bij uitlezen gevuld
     */
    private Money|null $openstaandSaldo = null;

    /**
     * Het factuurnummer.
     */
    private string|null $factuurnummer = null;

    /**
     * Het tijdstip waarop de factuur is of zal vervallen
     */
    private DateTimeImmutable|null $vervalDatum = null;

    private Relatie|null $relatie = null;

    /**
     * De datum waarop de factuur is aangemaakt
     */
    private DateTimeImmutable|null $factuurDatum = null;

    /**
     * Het totaal bedrag van de factuur
     */
    private Money|null $factuurBedrag = null;

    /** @var string[] */
    public static array $editableAttributes = [
        "inkoopBoeking",
        "openstaandSaldo",
        "factuurnummer",
        "vervalDatum",
        "relatie",
        "factuurDatum",
        "factuurBedrag",
    ];

    public function getInkoopboeking(): Inkoopboeking|null
    {
        return $this->inkoopBoeking;
    }

    public function setInkoopboeking(Inkoopboeking $inkoopboeking): self
    {
        $this->inkoopBoeking = $inkoopboeking;

        return $this;
    }

    public function getModifiedOn(): DateTimeImmutable|null
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(DateTimeImmutable $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getOpenstaandSaldo(): Money|null
    {
        return $this->openstaandSaldo;
    }

    public function setOpenstaandSaldo(Money $openstaandSaldo): self
    {
        $this->openstaandSaldo = $openstaandSaldo;

        return $this;
    }

    public function getFactuurnummer(): string|null
    {
        return $this->factuurnummer;
    }

    public function setFactuurnummer(string $factuurnummer): self
    {
        $this->factuurnummer = $factuurnummer;

        return $this;
    }

    public function getVervalDatum(): DateTimeImmutable|null
    {
        return $this->vervalDatum;
    }

    public function setVervalDatum(DateTimeImmutable $vervalDatum): self
    {
        $this->vervalDatum = $vervalDatum;

        return $this;
    }

    public function getRelatie(): Relatie|null
    {
        return $this->relatie;
    }

    public function setRelatie(Relatie $relatie): self
    {
        $this->relatie = $relatie;

        return $this;
    }

    public function getFactuurDatum(): DateTimeImmutable|null
    {
        return $this->factuurDatum;
    }

    public function setFactuurDatum(DateTimeImmutable $factuurDatum): self
    {
        $this->factuurDatum = $factuurDatum;

        return $this;
    }

    public function getFactuurBedrag(): Money|null
    {
        return $this->factuurBedrag;
    }

    public function setFactuurBedrag(Money $factuurBedrag): self
    {
        $this->factuurBedrag = $factuurBedrag;

        return $this;
    }
}