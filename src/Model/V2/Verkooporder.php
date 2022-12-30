<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\Adres;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model\Type\VerkooporderBtwIngave;
use SnelstartPHP\Snelstart;
use DateTimeImmutable;

final class Verkooporder extends SnelstartObject
{
    private Relatie|null $relatie = null;

    /**
     * Status van de order. Als deze niet is opgegeven wordt de default waarde order gebruikt. Contantbon en Factuur
     * zijn niet beschikbaar
     */
    private ProcesStatus|null $procesStatus = null;

    /**
     * Het ordernummer.
     */
    private int|null $nummer = null;

    /**
     * Het tijdstip waarop de verkooporder voor het laatst is gewijzigd.
     */
    private DateTimeImmutable|null $modifiedOn = null;

    /**
     * De orderdatum.
     */
    private DateTimeImmutable|null $datum = null;

    /**
     * De krediettermijn (in dagen) van de verkooporder.
     * Indien dit veld leeg is dan wordt het krediettermijn van de klant gebruikt.
     */
    private int|null $krediettermijn = null;

    /**
     * De omschrijving van de order.
     */
    private string|null $omschrijving = null;

    /**
     * Het betalingskenmerk van de order.
     */
    private string|null $betalingskenmerk = null;

    /**
     * De incassomachtiging.
     */
    private IncassoMachtiging|null $incassomachtiging = null;

    /**
     * Het afleveradres
     */
    private Adres|null $afleveradres = null;

    /**
     * Een container voor adres informatie.
     */
    private Adres|null $factuuradres = null;

    private VerkooporderBtwIngave|null $verkooporderBtwIngaveModel = null;

    private Kostenplaats|null $kostenplaats = null;

    /**
     * @var VerkooporderRegel[]|null
     */
    private array|null $regels = null;

    private string|null $memo = null;

    /**
     * De orderreferentie van een verkooporder. Deze wordt in de e-factuur en in de factuur als PDF opgenomen
     */
    private string|null $orderreferentie = null;

    private Money|null $factuurkorting = null;

    /**
     * Verkoopfactuur identifier
     */
    private Verkoopfactuur|null $verkoopfactuur = null;

    /**
     * Het te gebruiken sjaboon voor deze verkooporden. Dit veld is optioneel
     */
    private Verkoopordersjabloon|null $verkoopordersjabloon = null;

    private Money|null $totaalExclusiefBtw = null;

    private Money|null $totaalInclusiefBtw = null;

    /**
     * @var string[]
     */
    public static array $editableAttributes = [
        "relatie",
        "procesStatus",
        "nummer",
        "modifiedOn",
        "datum",
        "krediettermijn",
        "omschrijving",
        "betalingskenmerk",
        "incassomachtiging",
        "afleveradres",
        "factuuradres",
        "verkooporderBtwIngaveModel",
        "kostenplaats",
        "regels",
        "memo",
        "orderreferentie",
        "factuurkorting",
        "verkoopfactuur",
        "verkoopordersjabloon",
        "totaalExclusiefBtw",
        "totaalInclusiefBtw",
    ];

    public static function getEditableAttributes(): array
    {
        return array_unique(
            array_merge(
                parent::$editableAttributes,
                parent::getEditableAttributes(),
                self::$editableAttributes,
                self::$editableAttributes,
            ),
        );
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

    public function getProcesStatus(): ProcesStatus|null
    {
        return $this->procesStatus;
    }

    public function setProcesStatus(ProcesStatus $procesStatus): self
    {
        $this->procesStatus = $procesStatus;

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

    public function getModifiedOn(): DateTimeImmutable|null
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(DateTimeImmutable $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getDatum(): DateTimeImmutable|null
    {
        return $this->datum;
    }

    public function setDatum(DateTimeImmutable $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getKrediettermijn(): int|null
    {
        return $this->krediettermijn;
    }

    public function setKrediettermijn(int $krediettermijn): self
    {
        $this->krediettermijn = $krediettermijn;

        return $this;
    }

    public function getOmschrijving(): string|null
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getBetalingskenmerk(): string|null
    {
        return $this->betalingskenmerk;
    }

    public function setBetalingskenmerk(string $betalingskenmerk): self
    {
        $this->betalingskenmerk = $betalingskenmerk;

        return $this;
    }

    public function getIncassomachtiging(): IncassoMachtiging|null
    {
        return $this->incassomachtiging;
    }

    public function setIncassomachtiging(IncassoMachtiging|null $incassomachtiging): self
    {
        $this->incassomachtiging = $incassomachtiging;

        return $this;
    }

    public function getAfleveradres(): Adres|null
    {
        return $this->afleveradres;
    }

    public function setAfleveradres(Adres $afleveradres): self
    {
        $this->afleveradres = $afleveradres;

        return $this;
    }

    public function getFactuuradres(): Adres|null
    {
        return $this->factuuradres;
    }

    public function setFactuuradres(Adres $factuuradres): self
    {
        $this->factuuradres = $factuuradres;

        return $this;
    }

    public function getVerkooporderBtwIngaveModel(): VerkooporderBtwIngave|null
    {
        return $this->verkooporderBtwIngaveModel;
    }

    public function setVerkooporderBtwIngaveModel(VerkooporderBtwIngave $verkooporderBtwIngaveModel): self
    {
        $this->verkooporderBtwIngaveModel = $verkooporderBtwIngaveModel;

        return $this;
    }

    public function getKostenplaats(): Kostenplaats|null
    {
        return $this->kostenplaats;
    }

    public function setKostenplaats(Kostenplaats|null $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }

    /**
     * @return VerkooporderRegel[]
     */
    public function getRegels(): iterable|null
    {
        return $this->regels;
    }

    public function setRegels(VerkooporderRegel ...$regels): self
    {
        $this->regels = $regels;

        return $this;
    }

    public function getMemo(): string|null
    {
        return $this->memo;
    }

    public function setMemo(string|null $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getOrderreferentie(): string|null
    {
        return $this->orderreferentie;
    }

    public function setOrderreferentie(string|null $orderreferentie): self
    {
        $this->orderreferentie = $orderreferentie;

        return $this;
    }

    public function getFactuurkorting(): Money|null
    {
        return $this->factuurkorting;
    }

    public function setFactuurkorting(Money|null $factuurkorting): self
    {
        $this->factuurkorting = $factuurkorting;

        return $this;
    }

    public function getVerkoopfactuur(): Verkoopfactuur|null
    {
        return $this->verkoopfactuur;
    }

    public function setVerkoopfactuur(Verkoopfactuur|null $verkoopfactuur): self
    {
        $this->verkoopfactuur = $verkoopfactuur;

        return $this;
    }

    public function getVerkoopordersjabloon(): Verkoopordersjabloon|null
    {
        return $this->verkoopordersjabloon;
    }

    public function setVerkoopordersjabloon(Verkoopordersjabloon $verkoopordersjabloon): self
    {
        $this->verkoopordersjabloon = $verkoopordersjabloon;

        return $this;
    }

    public function getTotaalExclusiefBtw(): Money|null
    {
        return $this->totaalExclusiefBtw ?? new Money("0", Snelstart::getCurrency());
    }

    public function setTotaalExclusiefBtw(Money $totaalExclusiefBtw): self
    {
        $this->totaalExclusiefBtw = $totaalExclusiefBtw;

        return $this;
    }

    public function getTotaalInclusiefBtw(): Money|null
    {
        return $this->totaalInclusiefBtw ?? new Money("0", Snelstart::getCurrency());
    }

    public function setTotaalInclusiefBtw(Money $totaalInclusiefBtw): self
    {
        $this->totaalInclusiefBtw = $totaalInclusiefBtw;

        return $this;
    }
}
