<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Type\BtwSoort;

final class Boekingsregel extends BaseObject
{
    /**
     * De omschrijving van de boekingsregel.
     */
    private string|null $omschrijving = null;

    /**
     * De grootboekrekening waarop de mutatie (omzet) wordt geboekt.
     */
    private Grootboek $grootboek;

    /**
     * De kostenplaats waarop deze mutatie (omzet) is geregistreerd.
     */
    private Kostenplaats|null $kostenplaats = null;

    /**
     * Het omzetbedrag van de regel, exclusief btw.
     */
    private Money $bedrag;

    /**
     * Mag leeg worden gelaten of met de juiste waarde worden ingevuld behalve als de grootboek een
     * grootboekfunctie 30 (Inkopen kosten alle btwtarieven) of 34 (inkopen vraagposten) heeft.
     */
    private BtwSoort $btwSoort;

    public static array $editableAttributes = [
        "omschrijving",
        "grootboek",
        "kostenplaats",
        "bedrag",
        "btwSoort",
    ];

    public function getOmschrijving(): string|null
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getGrootboek(): Grootboek
    {
        return $this->grootboek;
    }

    public function setGrootboek(Grootboek $grootboek): self
    {
        $this->grootboek = $grootboek;

        return $this;
    }

    public function getKostenplaats(): Kostenplaats|null
    {
        return $this->kostenplaats;
    }

    public function setKostenplaats(Kostenplaats $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }

    public function getBedrag(): Money
    {
        return $this->bedrag;
    }

    public function setBedrag(Money $bedrag): self
    {
        $this->bedrag = $bedrag;

        return $this;
    }

    public function getBtwSoort(): BtwSoort
    {
        return $this->btwSoort;
    }

    public function setBtwSoort(BtwSoort $btwSoort): self
    {
        $this->btwSoort = $btwSoort;

        return $this;
    }
}