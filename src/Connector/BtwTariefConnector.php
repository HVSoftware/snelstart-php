<?php

declare(strict_types=1);

namespace SnelstartPHP\Connector;

use SnelstartPHP\Mapper\BtwTariefMapper;
use SnelstartPHP\Model\BtwTarief;
use SnelstartPHP\Request\BtwTariefRequest;

final class BtwTariefConnector extends BaseConnector
{
    /**
     * @return iterable<BtwTarief>
     */
    public function findAll(): iterable
    {
        $btwTariefRequest = new BtwTariefRequest();
        $btwTariefMapper = new BtwTariefMapper();

        yield from $btwTariefMapper->findAll($this->connection->doRequest($btwTariefRequest->findAll()));
    }
}
