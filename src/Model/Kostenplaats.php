<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

final class Kostenplaats extends SnelstartObject
{
    /**
     * De omschrijving van de kostenplaats.
     */
    private string $omschrijving;

    /**
     * Een vlag dat aangeeft of een kostenplaats niet meer actief is binnen de administratie.\r\nIndien
     * <see langword=\"true\" />, dan kan er niet geboekt worden op de kostenplaats.
     */
    private bool $nonactief;

    /**
     * Het nummer van de kostenplaats.
     */
    private int $nummer;

    /**
     * @var string[]
     */
    public static array $editableAttributes = [
        "omschrijving",
        "nonactief",
        "nummer",
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

    public function isNonactief(): bool|null
    {
        return $this->nonactief;
    }

    public function setNonactief(bool $nonactief): self
    {
        $this->nonactief = $nonactief;

        return $this;
    }

    public function getNummer(): int|null
    {
        return $this->nummer;
    }

    public function setNummer(int $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }
}