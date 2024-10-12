<?php

declare(strict_types=1);

/**
 * @deprecated
 *
 * @author     IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project    SnelstartApiPHP
 */

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use SnelstartPHP\Request\BaseRequest;

final class EchoRequest extends BaseRequest
{
    public function echo(string $input): RequestInterface
    {
        return new Request("GET", "echo/" . $input);
    }
}