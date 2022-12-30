<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Model\IncassoMachtiging;

final class Verkoopboeking extends Boeking
{
    /**
     * De klant/debiteur aan wie de factuur is gericht.
     *
     * @var Relatie|null
     */
    private $klant;

    /**
     * De betalingstermijn (in dagen) van de verkoopboeking.
     *
     * @var int|null
     */
    private $betalingstermijn;

    /**
     * De (optionele) eenmalige incassomachtiging waarmee deze factuur kan worden geïncasseerd.
     *
     * @var IncassoMachtiging|null
     */
    private $eenmaligeIncassoMachtiging;

    /**
     * De (optionele) doorlopende incassomachtiging waarmee deze factuur kan worden geïncasseerd.
     *
     * @var IncassoMachtiging|null
     */
    private $doorlopendeIncassoMachtiging;

    /**
     * @var string[]
     */
    public static $editableAttributes = [
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