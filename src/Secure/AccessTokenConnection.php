<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use SnelstartPHP\Exception\SnelstartApiAccessDeniedException;
use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;
use SnelstartPHP\Utils;
use function get_class;
use function http_build_query;
use function sprintf;

final class AccessTokenConnection implements ConnectionInterface
{
    public function __construct(
        private BearerTokenInterface $bearerToken,
        private ClientInterface|null $client = null,
        private LoggerInterface|null $logger = null,
    ) {
        $this->client = $client ?? new Client(
            [
                'base_uri'  =>  self::getEndpoint(),
            ],
        );
    }

    /**
     * @throws GuzzleException
     */
    public function doRequest(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->client->send($request);
        } catch (BadResponseException $badResponseException) {
            throw SnelstartApiAccessDeniedException::createFromParent($badResponseException);
        }
    }

    /**
     * Will throw an exception if we get anything other than a success.
     *
     * @throws GuzzleException
     */
    public function getToken(BearerTokenInterface|null $bearerToken = null): AccessToken
    {
        $this->bearerToken = $bearerToken ?? $this->bearerToken;

        $this->logger?->debug(
            sprintf(
                "[AccessToken] Trying to obtain an access token with token type '%s'",
                get_class($this->bearerToken),
            ),
        );

        $request = new Request(
            'POST',
            static::getEndpoint() . 'token',
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            http_build_query($this->bearerToken->getFormParams()),
        );

        $response = $this->doRequest($request);

        return new AccessToken(
            Utils::jsonDecode($response->getBody()->getContents(), true),
            $this->bearerToken,
        );
    }

    public static function getEndpoint(): string
    {
        return 'https://auth.snelstart.nl/b2b/';
    }
}