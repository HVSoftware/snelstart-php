<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Ramsey\Uuid\UuidInterface;

final class IncassoMachtiging extends SnelstartObject
{
    /**
     * @var string
     */
    private $kenmerk;

    /**
     * De omschrijving van de incassomachtiging.
     * Deze is verplicht bij een eenmalige machtiging.
     *
     * @var string
     */
    private $omschrijving;

    /**
     * De datum van de incassomachtiging
     * Deze is verplicht bij een eenmalige machtiging.
     *
     * @var \DateTimeInterface
     */
    private $datum;

    public function getKenmerk(): string
    {
        return $this->kenmerk;
    }

    public function setKenmerk(string $kenmerk): IncassoMachtiging
    {
        $this->kenmerk = $kenmerk;

        return $this;
    }

    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): IncassoMachtiging
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getDatum(): \DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): IncassoMachtiging
    {
        $this->datum = $datum;

        return $this;
    }

    public function isDoorlopendeIncassoMachtiging(): bool
    {
        return $this->id !== null;
    }
}