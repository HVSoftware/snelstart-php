<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use SnelstartPHP\Secure\ConnectionInterface;

abstract class BaseConnector
{
    protected ConnectionInterface $connection;

    public function __construct(ConnectionInterface $provider)
    {
        $this->setConnection($provider);
    }

    protected function setConnection(ConnectionInterface $provider): self
    {
        $this->connection = $provider;

        return $this;
    }
}