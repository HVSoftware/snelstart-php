<?php

declare(strict_types=1);

namespace SnelstartPHP;

use GuzzleHttp\Exception\InvalidArgumentException;
use function json_decode;
use function json_last_error;
use function json_last_error_msg;
use const JSON_ERROR_NONE;

final class Utils
{
    /**
     * Source package: guzzlehttp/guzzle
     *
     * Wrapper for json_decode that throws when an error occurs.
     *
     * @param string $json    JSON data to parse
     * @param bool   $assoc   When true, returned objects will be converted
     *                        into associative arrays.
     * @param int    $depth   User specified recursion depth.
     * @param int    $options Bitmask of JSON decode options.
     *
     * @throws InvalidArgumentException if the JSON cannot be decoded.
     *
     * @link https://www.php.net/manual/en/function.json-decode.php
     */
    public static function jsonDecode(
        string $json,
        bool $assoc = false,
        int $depth = 512,
        int $options = 0,
    ): float|object|array|bool|int|string|null {
        $data = json_decode($json, $assoc, $depth, $options);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException('json_decode error: ' . json_last_error_msg());
        }

        return $data;
    }
}