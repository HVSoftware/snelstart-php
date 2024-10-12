<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use DateTimeInterface;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type\Grootboekfunctie;
use SnelstartPHP\Model\Type\Rekeningcode;

final class Grootboek extends SnelstartObject
{
    /**
     * Het tijdstip waarop het grootboek is aangemaakt of voor het laatst is gewijzigd
     */
    private DateTimeInterface|null $modifiedOn = null;

    /**
     * De omschrijving van het grootboek.
     */
    private string|null $omschrijving = null;

    /**
     * Kostenplaats wel of niet verplicht bij het boeken.
     */
    private bool $kostenplaatsVerplicht;

    /**
     * Rekening code van het grootboek.
     */
    private Rekeningcode $rekeningCode;

    /**
     * Een vlag dat aangeeft of het grootboek niet meer actief is binnen de administratie.
     * Indien true, dan kan het grootboek als "verwijderd" worden beschouwd.
     */
    private bool $nonactief;

    /**
     * Het nummer van het grootboek.
     */
    private int $nummer;

    /**
     * De grootboekfunctie van het grootboek.
     */
    private Grootboekfunctie $grootboekfunctie;

    /**
     * RgsCodes
     *
     * @var RgsCode[]
     */
    private array $rgsCode = [];

    public function getModifiedOn(): DateTimeInterface|null
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(DateTimeInterface|null $modifiedOn): Grootboek
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getOmschrijving(): string|null
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): Grootboek
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function isKostenplaatsVerplicht(): bool
    {
        return $this->kostenplaatsVerplicht;
    }

    public function setKostenplaatsVerplicht(bool $kostenplaatsVerplicht): Grootboek
    {
        $this->kostenplaatsVerplicht = $kostenplaatsVerplicht;

        return $this;
    }

    public function getRekeningCode(): Rekeningcode
    {
        return $this->rekeningCode;
    }

    public function setRekeningCode(Rekeningcode $rekeningCode): Grootboek
    {
        $this->rekeningCode = $rekeningCode;

        return $this;
    }

    public function isNonactief(): bool
    {
        return $this->nonactief;
    }

    public function setNonactief(bool $nonactief): Grootboek
    {
        $this->nonactief = $nonactief;

        return $this;
    }

    public function getNummer(): int
    {
        return $this->nummer;
    }

    public function setNummer(int $nummer): Grootboek
    {
        $this->nummer = $nummer;

        return $this;
    }

    public function getGrootboekfunctie(): Grootboekfunctie
    {
        return $this->grootboekfunctie;
    }

    public function setGrootboekfunctie(Grootboekfunctie $grootboekfunctie): Grootboek
    {
        $this->grootboekfunctie = $grootboekfunctie;

        return $this;
    }

    public function getRgsCode(): array
    {
        return $this->rgsCode;
    }

    public function setRgsCode(RgsCode ...$rgsCode): Grootboek
    {
        $this->rgsCode = $rgsCode;

        return $this;
    }
}