<?php

declare(strict_types=1);

/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\SnelstartObject;
use function mb_strlen;

final class ArtikelOmzetgroep extends SnelstartObject
{
    /**
     * Omzetgroep nummer
     */
    private int|null $nummer = null;

    /**
     * Omschrijving van de omzetgroep
     */
    private string|null $omschrijving = null;

    /**
     * @var string[]
     */
    public static array $editableAttributes = [
        "nummer",
        "omschrijving",
    ];

    public function getNummer(): int|null
    {
        return $this->nummer;
    }

    public function setNummer(int|null $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }

    public function getOmschrijving(): string|null
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string|null $omschrijving): self
    {
        if ($omschrijving !== null && mb_strlen($omschrijving) > 50) {
            throw PreValidationException::textLengthException(mb_strlen($omschrijving), 50);
        }

        $this->omschrijving = $omschrijving;

        return $this;
    }
}