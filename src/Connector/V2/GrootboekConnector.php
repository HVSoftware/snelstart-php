<?php

declare(strict_types=1);

/**
 * @deprecated
 *
 * @author     IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project    SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\ODataRequestDataInterface;
use SnelstartPHP\Request\V2 as Request;

use function sprintf;

final class GrootboekConnector extends BaseConnector
{
    public function find(UuidInterface $id): Model\Grootboek|null
    {
        try {
            $mapper = new Mapper\GrootboekMapper();
            $request = new Request\GrootboekRequest();

            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException) {
            return null;
        }
    }

    /** @return iterable<Model\Grootboek> */
    public function findAll(
        ODataRequestDataInterface|null $ODataRequestData = null,
        bool $fetchAll = false,
        iterable|null $previousResults = null,
    ): iterable {
        $request = new Request\GrootboekRequest();
        $mapper = new Mapper\GrootboekMapper();
        $ODataRequestData ??= new ODataRequestData();
        $hasItems = false;

        foreach ($mapper->findAll($this->connection->doRequest($request->findAll($ODataRequestData))) as $grootboek) {
            $hasItems = true;

            yield $grootboek;
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

    public function findByNumber(string $number): Model\Grootboek|null
    {
        $criteria = (new ODataRequestData())->setFilter(
            [sprintf("Nummer eq %s", $number)],
        );

        $mapper = new Mapper\GrootboekMapper();
        $request = new Request\GrootboekRequest();

        foreach ($mapper->findAll($this->connection->doRequest($request->findAll($criteria))) as $grootboek) {
            return $grootboek;
        }

        return null;
    }
}