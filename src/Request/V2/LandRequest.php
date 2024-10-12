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
use Ramsey\Uuid\UuidInterface;

final class LandRequest
{
    public function findAll(): RequestInterface
    {
        return new Request("GET", "landen");
    }

    public function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "landen/" . $id->toString());
    }
}