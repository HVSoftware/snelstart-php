<?php

declare(strict_types=1);

/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use DateTimeInterface;
use Money\Money;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\SnelstartObject;

use function mb_strlen;

final class Artikel extends SnelstartObject
{
    private bool|null $isHoofdartikel = null;

    /** @var SubArtikel[] */
    private array $subArtikelen = [];

    private Prijsafspraak|null $prijsafspraak = null;

    private string $artikelcode;

    private string $omschrijving;

    /**
     * Een container voor atrikel omzet groep informatie.
     */
    private ArtikelOmzetgroep $artikelOmzetgroep;

    private Money $inkoopprijs;

    private Money $verkoopprijs;

    private string $eenheid;

    private DateTimeInterface $modifiedOn;

    /**
     * Een vlag dat aangeeft of een artikel niet meer actief is binnen de administratie.
     */
    private bool $isNonActief;

    /**
     * Een vlag dat aangeeft of voor een artikel wel of geen voorraad wordt bijgehouden.
     */
    private bool $voorraadControle;

    private float $technischeVoorraad;

    private float $vrijeVoorraad;

    /** @var string[] */
    public static array $editableAttributes = [
        "artikelcode",
        "omschrijving",
        "artikelOmzetgroep",
        "inkoopprijs",
        "verkoopprijs",
        "eenheid",
        "modifiedOn",
        "isNonActief",
        "voorraadControle",
        "technischeVoorraad",
        "vrijeVoorraad",
    ];

    public function isHoofdartikel(): bool|null
    {
        return $this->isHoofdartikel;
    }

    /** @return SubArtikel[] */
    public function getSubArtikelen(): iterable
    {
        return $this->subArtikelen;
    }

    public function addSubArtikel(SubArtikel $subArtikel): self
    {
        $this->subArtikelen[] = $subArtikel;

        return $this;
    }

    public function getPrijsafspraak(): Prijsafspraak|null
    {
        return $this->prijsafspraak;
    }

    public function setPrijsafspraak(Prijsafspraak|null $prijsafspraak): self
    {
        $this->prijsafspraak = $prijsafspraak;

        return $this;
    }

    public function getArtikelcode(): string
    {
        return $this->artikelcode;
    }

    public function setArtikelcode(string $artikelcode): self
    {
        $this->artikelcode = $artikelcode;

        return $this;
    }

    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        if (mb_strlen($omschrijving) > 250) {
            throw PreValidationException::textLengthException(mb_strlen($omschrijving), 250);
        }

        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getArtikelOmzetgroep(): ArtikelOmzetgroep|null
    {
        return $this->artikelOmzetgroep;
    }

    public function setArtikelOmzetgroep(ArtikelOmzetgroep $artikelOmzetgroep): self
    {
        $this->artikelOmzetgroep = $artikelOmzetgroep;

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

    public function getModifiedOn(): DateTimeInterface|null
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(DateTimeInterface $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function isNonActief(): bool|null
    {
        return $this->isNonActief;
    }

    public function setIsNonActief(bool $isNonActief): self
    {
        $this->isNonActief = $isNonActief;

        return $this;
    }

    public function isVoorraadControle(): bool|null
    {
        return $this->voorraadControle;
    }

    public function setVoorraadControle(bool $voorraadControle): self
    {
        $this->voorraadControle = $voorraadControle;

        return $this;
    }

    public function getTechnischeVoorraad(): float|null
    {
        return $this->technischeVoorraad;
    }

    public function setTechnischeVoorraad(float $technischeVoorraad): self
    {
        $this->technischeVoorraad = $technischeVoorraad;

        return $this;
    }

    public function getVrijeVoorraad(): float|null
    {
        return $this->vrijeVoorraad;
    }

    public function setVrijeVoorraad(float $vrijeVoorraad): self
    {
        $this->vrijeVoorraad = $vrijeVoorraad;

        return $this;
    }

    public function getInkoopprijs(): Money
    {
        return $this->inkoopprijs;
    }

    public function setInkoopprijs(Money $inkoopprijs): Artikel
    {
        $this->inkoopprijs = $inkoopprijs;

        return $this;
    }

    public function getEenheid(): string
    {
        return $this->eenheid;
    }

    public function setEenheid(string $eenheid): Artikel
    {
        $this->eenheid = $eenheid;

        return $this;
    }
}