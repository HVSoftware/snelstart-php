<?php

declare(strict_types=1);

namespace SnelstartPHP\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

final class BtwTariefRequest extends BaseRequest
{
    public function findAll(): RequestInterface
    {
        return new Request("GET", "btwtarieven");
    }
}
