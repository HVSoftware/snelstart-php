<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure\BearerToken;

final class ClientKeyBearerToken implements BearerTokenInterface
{
    public function __construct(private string $clientKey)
    {
    }

    public function getFormParams(): array
    {
        return [
            "grant_type"    =>  "clientkey",
            "clientkey"     =>  $this->clientKey,
        ];
    }
}