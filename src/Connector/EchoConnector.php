<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Connector;

use SnelstartPHP\Request\EchoRequest;

final class EchoConnector extends BaseConnector
{
    public function echo(string $input): string
    {
        return str_replace('"', "", $this->connection->doRequest((new EchoRequest())->echo($input))->getBody()->getContents());
    }
}