<?php

declare(strict_types=1);

namespace SnelstartPHP\Model\V2;

use DateTimeImmutable;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Type\BtwSoort;

final class BtwTarief extends BaseObject
{
    private BtwSoort $btwSoort;

    private float $btwPercentage;

    private DateTimeImmutable $datumVanaf;

    private DateTimeImmutable $datumTotEnMet;

    /**
     * @var string[]
     */
    public static array $editableAttributes = [];

    public function getBtwSoort(): BtwSoort
    {
        return $this->btwSoort;
    }

    /**
     * @return $this
     */
    public function setBtwSoort(BtwSoort $btwSoort): self
    {
        $this->btwSoort = $btwSoort;

        return $this;
    }

    public function getBtwPercentage(): float
    {
        return $this->btwPercentage;
    }

    /**
     * @return $this
     */
    public function setBtwPercentage(float $btwPercentage): self
    {
        $this->btwPercentage = $btwPercentage;

        return $this;
    }

    public function getDatumVanaf(): DateTimeImmutable
    {
        return $this->datumVanaf;
    }

    /**
     * @return $this
     */
    public function setDatumVanaf(DateTimeImmutable $datumVanaf): self
    {
        $this->datumVanaf = $datumVanaf;

        return $this;
    }

    public function getDatumTotEnMet(): DateTimeImmutable|null
    {
        return $this->datumTotEnMet;
    }

    /**
     * @return $this
     */
    public function setDatumTotEnMet(DateTimeImmutable $datumTotEnMet): self
    {
        $this->datumTotEnMet = $datumTotEnMet;

        return $this;
    }
}
