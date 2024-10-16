<?php

declare(strict_types=1);

/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Ramsey\Uuid\Uuid;
use SnelstartPHP\Exception\InvalidMapperDataException;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\Adres;
use SnelstartPHP\Model\Land;

use function array_diff;
use function array_keys;
use function count;

final class AdresMapper extends AbstractMapper
{
    /** @throws InvalidMapperDataException */
    public function mapAdresToSnelstartObject(array $data): Adres
    {
        $mandatoryParameters = ["contactpersoon", "straat", "postcode", "plaats", "land"];
        $diff = array_diff(array_keys($data), $mandatoryParameters);

        if (count($diff) > 0) {
            throw InvalidMapperDataException::mandatoryKeysAreMissing(...$diff);
        }

        return (new Adres())
            ->setContactpersoon($data["contactpersoon"])
            ->setStraat($data["straat"])
            ->setPostcode($data["postcode"])
            ->setPlaats($data["plaats"])
            ->setLand(Land::createFromUUID(Uuid::fromString($data["land"]["id"])));
    }
}