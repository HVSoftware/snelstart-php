<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\SnelstartObject;

final class Verkoopfactuur extends SnelstartObject
{
    /**
     * De verkoopboeking bij de factuur
     *
     * @var Verkoopboeking|null
     */
    private $verkoopBoeking;

    /**
     * Het tijdstip waarop de verkoopfactuur voor het laatst is gewijzigd.
     *
     * @var \DateTimeImmutable|null
     */
    private $modifiedOn;

    /**
     * Het openstaand saldo van de verkoopfactuur.\r\nDeze wordt alleen bij uitlezen gevuld
     *
     * @var Money|null
     */
    private $openstaandSaldo;

    /**
     * Het factuurnummer.
     *
     * @var string|null
     */
    private $factuurnummer;

    /**
     * Het tijdstip waarop de factuur is of zal vervallen
     *
     * @var \DateTimeImmutable|null
     */
    private $vervalDatum;

    /**
     * @var Relatie|null
     */
    private $relatie;

    /**
     * De datum waarop de factuur is aangemaakt
     *
     * @var \DateTimeImmutable|null
     */
    private $factuurDatum;

    /**
     * Het totaal bedrag van de factuur
     *
     * @var Money|null
     */
    private $factuurBedrag;

    /**
     * @var string[]
     */
    public static $editableAttributes = [
        "verkoopBoeking",
        "openstaandSaldo",
        "factuurnummer",
        "vervalDatum",
        "relatie",
        "factuurDatum",
        "factuurBedrag",
    ];

    public function getVerkoopBoeking(): Verkoopboeking|null
    {
        return $this->verkoopBoeking;
    }

    public function setVerkoopBoeking(Verkoopboeking $verkoopBoeking): self
    {
        $this->verkoopBoeking = $verkoopBoeking;

        return $this;
    }

    public function getModifiedOn(): \DateTimeImmutable|null
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(\DateTimeImmutable $modifiedOn): self
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

    public function getVervalDatum(): \DateTimeImmutable|null
    {
        return $this->vervalDatum;
    }

    public function setVervalDatum(\DateTimeImmutable $vervalDatum): self
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

    public function getFactuurDatum(): \DateTimeImmutable|null
    {
        return $this->factuurDatum;
    }

    public function setFactuurDatum(\DateTimeImmutable $factuurDatum): self
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