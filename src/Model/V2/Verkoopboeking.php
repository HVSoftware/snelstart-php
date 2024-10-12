<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Model\IncassoMachtiging;

use function array_merge;
use function array_unique;

final class Verkoopboeking extends Boeking
{
    /**
     * De klant/debiteur aan wie de factuur is gericht.
     */
    private Relatie|null $klant = null;

    /**
     * De betalingstermijn (in dagen) van de verkoopboeking.
     */
    private int|null $betalingstermijn = null;

    /**
     * De (optionele) eenmalige incassomachtiging waarmee deze factuur kan worden geïncasseerd.
     */
    private IncassoMachtiging|null $eenmaligeIncassoMachtiging = null;

    /**
     * De (optionele) doorlopende incassomachtiging waarmee deze factuur kan worden geïncasseerd.
     */
    private IncassoMachtiging|null $doorlopendeIncassoMachtiging = null;

    /** @var string[] */
    public static array $editableAttributes = [
        "klant",
        "betalingstermijn",
        "eenmaligeIncassoMachtiging",
        "doorlopendeIncassoMachtiging",
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

    public function getKlant(): Relatie|null
    {
        return $this->klant;
    }

    public function setKlant(Relatie $klant): self
    {
        $this->klant = $klant;

        return $this;
    }

    public function getBetalingstermijn(): int|null
    {
        return $this->betalingstermijn;
    }

    public function setBetalingstermijn(int $betalingstermijn): self
    {
        $this->betalingstermijn = $betalingstermijn;

        return $this;
    }

    public function getEenmaligeIncassoMachtiging(): IncassoMachtiging|null
    {
        return $this->eenmaligeIncassoMachtiging;
    }

    public function setEenmaligeIncassoMachtiging(IncassoMachtiging|null $eenmaligeIncassoMachtiging): self
    {
        $this->eenmaligeIncassoMachtiging = $eenmaligeIncassoMachtiging;

        return $this;
    }

    public function getDoorlopendeIncassoMachtiging(): IncassoMachtiging|null
    {
        return $this->doorlopendeIncassoMachtiging;
    }

    public function setDoorlopendeIncassoMachtiging(IncassoMachtiging|null $doorlopendeIncassoMachtiging): self
    {
        $this->doorlopendeIncassoMachtiging = $doorlopendeIncassoMachtiging;

        return $this;
    }
}