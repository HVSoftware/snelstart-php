<?php

declare(strict_types=1);

namespace SnelstartPHP\Mapper\V2\Relatie;

use DateTimeImmutable;
use Exception;
use Generator;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2\Relatie;
use SnelstartPHP\Model\V2\Relatie\DoorlopendeIncassoMachtiging;

use function assert;

final class DoorlopendeIncassoMachtigingMapper extends AbstractMapper
{
    public function findByRelatie(ResponseInterface $response): Generator
    {
        $this->setResponseData($response);

        foreach ($this->responseData as $doorlopendeIncassoMachtiging) {
            yield $this->mapResultToDoorlopendeIncassoMachtiging(
                new DoorlopendeIncassoMachtiging(),
                $doorlopendeIncassoMachtiging,
            );
        }
    }

    private function mapResultToDoorlopendeIncassoMachtiging(
        DoorlopendeIncassoMachtiging $doorlopendeIncassoMachtiging,
        array $data = [],
    ): DoorlopendeIncassoMachtiging {
        $data = empty($data) ? $this->responseData : $data;
        $object = $this->mapArrayDataToModel($doorlopendeIncassoMachtiging, $data);
        assert($object instanceof DoorlopendeIncassoMachtiging);

        if (isset($data["afsluitDatum"])) {
            try {
                $object->setAfsluitDatum(new DateTimeImmutable($data["afsluitDatum"]));
            } catch (Exception) {
                // This is caused by an invalid date format.
            }
        }

        if (isset($data["intrekkingsDatum"])) {
            try {
                $object->setIntrekkingsDatum(new DateTimeImmutable($data["intrekkingsDatum"]));
            } catch (Exception) {
                // This is caused by an invalid date format.
            }
        }

        if (isset($data["klant"])) {
            $object->setKlant(Relatie::createFromUUID(Uuid::fromString($data["klant"]["id"])));
        }

        return $object;
    }
}