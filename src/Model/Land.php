<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

final class Land extends SnelstartObject
{
    /**
     * De naam van het land.
     */
    private string $naam;

    /**
     * De ISO code van het land.
     */
    private string $landcodeISO;

    /**
     * De code van het land.
     */
    private string $landcode;

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getLandcodeISO(): string
    {
        return $this->landcodeISO;
    }

    public function setLandcodeISO(string $landcodeISO): self
    {
        $this->landcodeISO = $landcodeISO;

        return $this;
    }

    public function getLandcode(): string
    {
        return $this->landcode;
    }

    public function setLandcode(string $landcode): self
    {
        $this->landcode = $landcode;

        return $this;
    }
}