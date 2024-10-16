<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Model\SnelstartObject;

final class Verkoopordersjabloon extends SnelstartObject
{
    /**
     * De omschrijving van het sjabloon.
     */
    private string|null $omschrijving = null;

    /**
     * Een vlag dat aangeeft of een sjabloon niet meer actief is binnen de administratie.\r\nIndien
     * <see langword=\"true\" />, dan kan het sjabloon als \"verwijderd\" worden beschouwd.
     */
    private bool|null $nonactief = null;

    /**
     * @var bool|null
     *
     * Exclusief btw: In dat geval worden de verkoopprijzen in het verkoopscherm van SnelStart 12 en op de factuur
     * exclusief btw weergegeven;
     * Inclusief btw: In dat geval worden de verkoopprijzen in het verkoopscherm van SnelStart 12 en op de factuur
     * inclusief btw weergegeven
     */
    private bool|null $prijsIngaveExclusiefBtw = null;

    public function getOmschrijving(): string|null
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getNonactief(): bool|null
    {
        return $this->nonactief;
    }

    public function setNonactief(bool $nonactief): self
    {
        $this->nonactief = $nonactief;

        return $this;
    }

    public function getPrijsIngaveExclusiefBtw(): bool|null
    {
        return $this->prijsIngaveExclusiefBtw;
    }

    public function setPrijsIngaveExclusiefBtw(bool $prijsIngaveExclusiefBtw): self
    {
        $this->prijsIngaveExclusiefBtw = $prijsIngaveExclusiefBtw;

        return $this;
    }
}