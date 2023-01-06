<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\ArtikelOmzetgroepMapper;
use SnelstartPHP\Model\ArtikelOmzetgroep;
use SnelstartPHP\Request\ArtikelOmzetgroepRequest;

final class ArtikelOmzetgroepConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?ArtikelOmzetgroep
    {
        try {
            $mapper = new ArtikelOmzetgroepMapper();
            $request = new ArtikelOmzetgroepRequest();

            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @return iterable<ArtikelOmzetgroep>
     */
    public function findAll(): iterable
    {
        $mapper = new ArtikelOmzetgroepMapper();
        $request = new ArtikelOmzetgroepRequest();

        yield from $mapper->findAll($this->connection->doRequest($request->findAll()));
    }
}
