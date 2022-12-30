<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Type\BtwRegelSoort;

final class Btwregel extends BaseObject
{
    private BtwRegelSoort $btwSoort;

    public static array $editableAttributes = [
        "btwSoort",
        "btwBedrag",
    ];

    public function __construct(BtwRegelSoort $btwRegelSoort, private Money $btwBedrag)
    {
        $this->btwSoort = $btwRegelSoort;
    }

    public function getBtwSoort(): BtwRegelSoort
    {
        return $this->btwSoort;
    }

    public function setBtwSoort(BtwRegelSoort $btwSoort): self
    {
        $this->btwSoort = $btwSoort;

        return $this;
    }

    public function getBtwBedrag(): Money
    {
        return $this->btwBedrag;
    }

    public function setBtwBedrag(Money $btwBedrag): self
    {
        $this->btwBedrag = $btwBedrag;

        return $this;
    }
}