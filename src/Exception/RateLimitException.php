<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Exception;

use RuntimeException;
use Throwable;

final class RateLimitException extends RuntimeException
{
    public function __construct(
        $message = "Rate Limit for the API has been reached",
        $code = 0,
        Throwable|null $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}