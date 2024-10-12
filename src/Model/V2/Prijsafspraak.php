<?php

declare(strict_types=1);

namespace SnelstartPHP\Model\V2;

use DateTimeInterface;
use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Type\PrijsBepalingSoort;

final class Prijsafspraak extends BaseObject
{
    private Relatie|null $relatie = null;

    private Artikel $artikel;

    private DateTimeInterface $datum;

    private float $aantal;

    private float $korting;

    private Money $verkoopprijs;

    private Money $basisprijs;

    private DateTimeInterface|null $datumVanaf = null;

    private DateTimeInterface|null $datumTotEnMet = null;

    private PrijsBepalingSoort $prijsBepalingSoort;

    /** @var string[] */
    public static array $editableAttributes = [];

    public function getRelatie(): Relatie|null
    {
        return $this->relatie;
    }

    public function setRelatie(Relatie|null $relatie): self
    {
        $this->relatie = $relatie;

        return $this;
    }

    public function getArtikel(): Artikel
    {
        return $this->artikel;
    }

    public function setArtikel(Artikel $artikel): self
    {
        $this->artikel = $artikel;

        return $this;
    }

    public function getDatum(): DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getAantal(): float
    {
        return $this->aantal;
    }

    public function setAantal(float $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getKorting(): float
    {
        return $this->korting;
    }

    public function setKorting(float $korting): Prijsafspraak
    {
        $this->korting = $korting;

        return $this;
    }

    public function getVerkoopprijs(): Money
    {
        return $this->verkoopprijs;
    }

    public function setVerkoopprijs(Money $verkoopprijs): self
    {
        $this->verkoopprijs = $verkoopprijs;

        return $this;
    }

    public function getBasisprijs(): Money
    {
        return $this->basisprijs;
    }

    public function setBasisprijs(Money $basisprijs): self
    {
        $this->basisprijs = $basisprijs;

        return $this;
    }

    public function getDatumVanaf(): DateTimeInterface|null
    {
        return $this->datumVanaf;
    }

    public function setDatumVanaf(DateTimeInterface|null $datumVanaf): self
    {
        $this->datumVanaf = $datumVanaf;

        return $this;
    }

    public function getDatumTotEnMet(): DateTimeInterface|null
    {
        return $this->datumTotEnMet;
    }

    public function setDatumTotEnMet(DateTimeInterface|null $datumTotEnMet): self
    {
        $this->datumTotEnMet = $datumTotEnMet;

        return $this;
    }

    public function getPrijsBepalingSoort(): PrijsBepalingSoort
    {
        return $this->prijsBepalingSoort;
    }

    public function setPrijsBepalingSoort(PrijsBepalingSoort $prijsBepalingSoort): self
    {
        $this->prijsBepalingSoort = $prijsBepalingSoort;

        return $this;
    }
}