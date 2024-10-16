<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper;

use DateTimeImmutable;
use Money\Money;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Snelstart;
use SnelstartPHP\Utils;
use TypeError;

use function floatval;
use function intval;
use function is_null;
use function is_scalar;
use function is_string;
use function method_exists;
use function strpos;
use function substr;
use function trigger_error;
use function ucfirst;

use const E_USER_DEPRECATED;

abstract class AbstractMapper
{
    /** @var array */
    protected array $responseData = [];

    /** @deprecated This will be deprecated starting from April 1st 2020 */
    final public function __construct(ResponseInterface|null $response = null)
    {
        if ($response !== null) {
            @trigger_error("This will be deprecated starting from April 1st 2020", E_USER_DEPRECATED);

            return static::fromResponse($response);
        }
    }

    /**
     * Map the array data to the given class.
     *
     * @psalm-param  T $class
     *
     * @psalm-return T
     *
     * @template     T of SnelstartObject
     */
    protected function mapArrayDataToModel(SnelstartObject $class, array $data = []): SnelstartObject
    {
        foreach ((empty($data) ? $this->responseData : $data) as $key => $value) {
            $class = $this->setDataToModel($class, $key, $value);
        }

        return $class;
    }

    protected function getMoney(string $money): Money
    {
        return new Money(intval(floatval($money) * 100), Snelstart::getCurrency());
    }

    /**
     * @psalm-param  T $class
     *
     * @psalm-return T
     *
     * @template     T of SnelstartObject
     */
    protected function setDataToModel(SnelstartObject $class, string $key, $value): SnelstartObject
    {
        $methodName = "set" . ucfirst($key);
        $customSet = false;

        if ($key === "id" && is_string($value)) {
            $value = Uuid::fromString($value);
            $customSet = true;
        } elseif (substr($key, -2, 2) === "On" || strpos($key, "datum") !== false) {
            $value = DateTimeImmutable::createFromFormat(Snelstart::DATETIME_FORMAT, $value);

            if (! $value) {
                $value = null;
            }

            $customSet = true;
        }

        try {
            if (method_exists($class, $methodName)) {
                // We only do scalar values. Complex values can be handled in Mapper classes.
                if (is_scalar($value) || is_null($value) || $customSet) {
                    $class->{$methodName}($value);
                }
            }
        } catch (TypeError) {
        }

        return $class;
    }

    protected function setResponseData(ResponseInterface $response): self
    {
        $this->responseData = Utils::jsonDecode($response->getBody()->getContents(), true);

        // Always make sure that we are dealing with arrays even when the response is empty (201 created for example).
        if ($this->responseData === null) {
            $this->responseData = [];
        }

        return $this;
    }

    protected static function fromResponse(ResponseInterface $response): self
    {
        return (new static())->setResponseData($response);
    }
}