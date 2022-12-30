<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Model\SnelstartObject;

final class SubArtikel extends SnelstartObject
{
    private string|null $artikelcode = null;

    private float|null $aantal = null;

    /** @var string[] */
    public static array $editableAttributes = [
        "artikelcode",
        "aantal",
    ];

    public function getArtikelcode(): string|null
    {
        return $this->artikelcode;
    }

    public function setArtikelcode(string $artikelcode): SubArtikel
    {
        $this->artikelcode = $artikelcode;

        return $this;
    }

    public function getAantal(): float|null
    {
        return $this->aantal;
    }

    public function setAantal(float $aantal): SubArtikel
    {
        $this->aantal = $aantal;

        return $this;
    }
}