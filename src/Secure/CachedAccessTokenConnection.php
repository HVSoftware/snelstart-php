<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;
use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;

use function random_int;
use function spl_object_hash;

final class CachedAccessTokenConnection
{
    private AccessTokenConnection $connection;

    /**
     * Prefix to use to store the access token.
     */
    private const CACHE_ITEM_PREFIX = "snelstart.access_token.";

    /**
     * Allow a little wiggle room for the token expiry.
     */
    private const EXPIRES_AFTER_BUFFER = 60;

    public function __construct(
        AccessTokenConnection $accessTokenConnection,
        private CacheItemPoolInterface $cacheItemPool,
        private LoggerInterface|null $logger = null,
    ) {
        $this->connection = $accessTokenConnection;
    }

    /**
     * @throws RuntimeException
     * @throws InvalidArgumentException
     * @throws GuzzleException
     */
    public function getToken(BearerTokenInterface|null $bearerToken = null): AccessToken
    {
        $cacheItem = $this->cacheItemPool->getItem($this->getItemKey());

        if ($cacheItem->isHit()) {
            if ($this->logger !== null) {
                $this->logger->debug("[AccessToken] Successfully retrieved from cache.");
            }

            return $cacheItem->get();
        }

        if ($this->logger !== null) {
            $this->logger->debug("[AccessToken] Get an access token from Snelstart");
        }

        $accessToken = $this->connection->getToken($bearerToken);
        $cacheItem
            ->set($accessToken)
            ->expiresAfter($accessToken->getExpiresIn() - self::EXPIRES_AFTER_BUFFER);

        if (! $this->cacheItemPool->save($cacheItem)) {
            throw new RuntimeException("Something went wrong trying to persist the access token into cache.");
        }

        return $accessToken;
    }

    protected function getItemKey(): string
    {
        return self::CACHE_ITEM_PREFIX . spl_object_hash($this) . random_int(0, 99);
    }
}