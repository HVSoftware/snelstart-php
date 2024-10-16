<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use DateTime;
use DateTimeZone;
use InvalidArgumentException;
use JsonSerializable;
use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;

use function is_numeric;

final class AccessToken implements JsonSerializable
{
    protected string $accessToken;

    protected string $tokenType;

    protected int $expires;

    public function __construct(array $options, protected BearerTokenInterface $bearerToken)
    {
        if (empty($options['access_token'])) {
            throw new InvalidArgumentException('Required option not passed: "access_token"');
        }

        if (empty($options['expires_in']) || ! is_numeric($options['expires_in'])) {
            throw new InvalidArgumentException('expires_in value must be an integer');
        }

        $this->accessToken = $options['access_token'];
        $this->tokenType = $options['token_type'] ?? 'bearer';
        $this->expires = $options['expires_in'] !== 0
            ? $this->getCurrentUtcTimestamp() + (int) $options['expires_in']
            : 0;
    }

    private function getCurrentUtcTimestamp(): int
    {
        return (new DateTime('now', new DateTimeZone('UTC')))->getTimestamp();
    }

    public function getExpiresIn(): int
    {
        return $this->expires - $this->getCurrentUtcTimestamp();
    }

    public function isExpired(): bool
    {
        // Add a margin of 20 seconds to account for server timing differences.
        return $this->getExpiresIn() < 20;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getBearerToken(): BearerTokenInterface
    {
        return $this->bearerToken;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function jsonSerialize(): array
    {
        return [
            'access_token'  =>  $this->accessToken,
            'token_type'    =>  $this->tokenType,
            'expires_in'    =>  $this->getExpiresIn(),
            'expires'       =>  $this->expires,
        ];
    }

    public function __toString(): string
    {
        return $this->getAccessToken();
    }
}
