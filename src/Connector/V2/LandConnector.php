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
use SnelstartPHP\Mapper\V2\LandMapper;
use SnelstartPHP\Model\Land;
use SnelstartPHP\Request\V2\LandRequest;

final class LandConnector extends BaseConnector
{
    public function find(UuidInterface $id): Land|null
    {
        try {
            $mapper = new LandMapper();
            $request = new LandRequest();

            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException) {
            return null;
        }
    }

    /** @return iterable<Land> */
    public function findAll(): iterable
    {
        $mapper = new LandMapper();
        $request = new LandRequest();

        yield from $mapper->findAll($this->connection->doRequest($request->findAll()));
    }
}