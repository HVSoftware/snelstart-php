<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Exception;

use Countable;
use RuntimeException;
use function count;
use function json_encode;

final class SnelstartApiErrorException extends RuntimeException
{
    public static function handleError(array $body): self
    {
        if (isset($body["modelState"])) {
            $errorMessages = [
                sprintf(
                    "%d validation failures occurred.",
                    is_array(
                        $body["modelState"],
                    ) || $body["modelState"] instanceof Countable ? count($body["modelState"]) : 0,
                ),
            ];

            foreach ($body["modelState"] as $field => $modelStateErrors) {
                $errorMessages[] = $field . ": ";

                foreach ($modelStateErrors as $modelStateError) {
                    $errorMessages[] = sprintf("\t%s", $modelStateError);
                }
            }

            return new SnelstartApiErrorException(implode("\n", $errorMessages), 400);
        }

        if (isset($body[0])) {
            $errorMessages = [];

            foreach ($body as $bodyErrorItem) {
                $errorMessages[] = sprintf("%s: %s", $bodyErrorItem["errorCode"], $bodyErrorItem["message"]);
            }

            return new SnelstartApiErrorException(implode("\n", $errorMessages), 400);
        }

        // Inconsistent...
        if (isset($body["Message"]) || isset($body["message"])) {
            return new SnelstartApiErrorException($body["Message"] ?? $body["message"], 400);
        }

        throw new SnelstartApiErrorException("Unknown exception. Message body: " . json_encode($body), 400);
    }
}