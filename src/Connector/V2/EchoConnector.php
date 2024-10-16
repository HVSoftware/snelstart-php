<?php

declare(strict_types=1);

/**
 * @deprecated
 *
 * @author     IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project    SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Request\V2\EchoRequest;

use function str_replace;

final class EchoConnector extends BaseConnector
{
    public function echo(string $input): string
    {
        return str_replace(
            '"',
            "",
            $this->connection->doRequest((new EchoRequest())->echo($input))->getBody()->getContents(),
        );
    }
}