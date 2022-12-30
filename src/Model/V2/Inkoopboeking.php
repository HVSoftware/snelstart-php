<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

final class Inkoopboeking extends Boeking
{
    /**
     * De leverancier/crediteur van wie de factuur afkomstig is.
     */
    private Relatie $leverancier;

    /**
     * @var string[]
     */
    public static $editableAttributes = ['leverancier'];

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

    public function getLeverancier(): Relatie|null
    {
        return $this->leverancier;
    }

    public function setLeverancier(Relatie $leverancier): self
    {
        $this->leverancier = $leverancier;

        return $this;
    }
}