<?php

declare(strict_types=1);

/**
 * @see     https://b2bapi-developer.snelstart.nl/granttype_password
 *
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure\BearerToken;

use InvalidArgumentException;

use function base64_decode;
use function count;
use function explode;
use function sprintf;

final class PasswordBearerToken implements BearerTokenInterface
{
    private string $username;

    private string $password;

    /**
     * The variable $koppelsleutel is according to the specs base64 encoded. Decode it and look for a ':'.
     */
    public function __construct(string $koppelsleutel)
    {
        $koppelsleutelParts = explode(":", base64_decode($koppelsleutel));

        if (count($koppelsleutelParts) !== 2) {
            throw new InvalidArgumentException(
                sprintf("We expected 2 items while decoding this but we got %d", count($koppelsleutelParts)),
            );
        }

        $this->username = $koppelsleutelParts[0];
        $this->password = $koppelsleutelParts[1];
    }

    public function getFormParams(): array
    {
        return [
            "grant_type"    =>  "password",
            "username"      =>  $this->username,
            "password"      =>  $this->password,
        ];
    }
}