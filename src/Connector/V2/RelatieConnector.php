<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model\Type\Relatiesoort;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\ODataRequestDataInterface;
use SnelstartPHP\Request\V2 as Request;

use function array_merge;
use function iterator_to_array;
use function method_exists;
use function sprintf;

final class RelatieConnector extends BaseConnector
{
    public function find(UuidInterface $id): Model\Relatie|null
    {
        try {
            $mapper = new Mapper\RelatieMapper();
            $request = new Request\RelatieRequest();

            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException) {
            return null;
        }
    }

    public function findDoorlopendeIncassoMachtigingen(UuidInterface $id): array
    {
        $mapper = new Mapper\Relatie\DoorlopendeIncassoMachtigingMapper();
        $request = new Request\RelatieRequest();

        return iterator_to_array(
            $mapper->findByRelatie($this->connection->doRequest($request->findDoorlopendeIncassoMachtigingen($id))),
        );
    }

    /** @return iterable<Model\Relatie> */
    public function findAll(
        ODataRequestDataInterface|null $ODataRequestData = null,
        bool $fetchAll = false,
        iterable|null $previousResults = null,
    ): iterable {
        $mapper = new Mapper\RelatieMapper();
        $request = new Request\RelatieRequest();
        $ODataRequestData ??= new ODataRequestData();
        $hasItems = false;

        foreach ($mapper->findAll($this->connection->doRequest($request->findAll($ODataRequestData))) as $relatie) {
            $hasItems = true;

            yield $relatie;
        }

        if (! $fetchAll || ! $hasItems) {
            return;
        }

        if ($previousResults === null) {
            $ODataRequestData->setSkip($ODataRequestData->getTop());
        } else {
            $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
        }

        yield from $this->findAll($ODataRequestData, true, []);
    }

    /**
     * @return       Model\Relatie[]
     * @psalm-return iterable<int, Model\Relatie>
     */
    public function findAllLeveranciers(
        ODataRequestDataInterface|null $ODataRequestData = null,
        bool $fetchAll = false,
        iterable|null $previousResults = null,
    ): iterable {
        $ODataRequestData ??= new ODataRequestData();

        if (method_exists($ODataRequestData, "setFilter")) {
            $ODataRequestData->setFilter(
                array_merge(
                    $ODataRequestData->getFilter(),
                    [sprintf("Relatiesoort/any(soort:soort eq '%s')", Relatiesoort::LEVERANCIER()->getValue())],
                ),
            );
        }

        yield from $this->findAll($ODataRequestData, $fetchAll, $previousResults);
    }

    /**
     * @return       Model\Relatie[]|iterable
     * @psalm-return iterable<int, Model\Relatie>
     */
    public function findAllKlanten(
        ODataRequestDataInterface|null $ODataRequestData = null,
        bool $fetchAll = false,
        iterable|null $previousResults = null,
    ): iterable {
        $ODataRequestData ??= new ODataRequestData();

        if (method_exists($ODataRequestData, "setFilter")) {
            $ODataRequestData->setFilter(
                array_merge(
                    $ODataRequestData->getFilter(),
                    [sprintf("Relatiesoort/any(soort:soort eq '%s')", Relatiesoort::KLANT()->getValue())],
                ),
            );
        }

        yield from $this->findAll($ODataRequestData, $fetchAll, $previousResults);
    }

    public function add(Model\Relatie $relatie): Model\Relatie
    {
        if ($relatie->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        $mapper = new Mapper\RelatieMapper();
        $request = new Request\RelatieRequest();

        return $mapper->add($this->connection->doRequest($request->add($relatie)));
    }

    public function update(Model\Relatie $relatie): Model\Relatie
    {
        if ($relatie->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        $mapper = new Mapper\RelatieMapper();
        $request = new Request\RelatieRequest();

        return $mapper->update($this->connection->doRequest($request->update($relatie)));
    }
}