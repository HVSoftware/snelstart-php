<?php

declare(strict_types=1);

namespace SnelstartPHP\Request;

use DateTimeInterface;
use JsonSerializable;
use LogicException;
use Money\Money;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Serializer\RequestSerializerInterface;
use SnelstartPHP\Serializer\SnelstartRequestRequestSerializer;

use function count;
use function gettype;
use function is_array;
use function is_scalar;
use function method_exists;
use function sprintf;
use function trigger_error;
use function ucfirst;

abstract class BaseRequest
{
    public function __construct(protected RequestSerializerInterface|null $serializer = null)
    {
        $this->serializer = $serializer ?? new SnelstartRequestRequestSerializer();
    }

    /**
     * Iterate over the Model objects and ask for the editable attributes. We will only serialize the editable fields
     * in this case.
     *
     * @param string[] $editableAttributes
     */
    public function prepareAddOrEditRequestForSerialization(BaseObject $object, string ...$editableAttributes): array
    {
        $serialize = [];

        if (count($editableAttributes) === 0) {
            $editableAttributes = $object::getEditableAttributes();
        }

        foreach ($editableAttributes as $editableAttributeName) {
            $methodExists = false;
            $methodName = null;
            $methodNames = [
                "get" . ucfirst($editableAttributeName),
                "is" . ucfirst($editableAttributeName),
            ];

            foreach ($methodNames as $methodName) {
                if (method_exists($object, $methodName)) {
                    $methodExists = true;
                    break;
                }
            }

            if (! $methodExists) {
                trigger_error(
                    sprintf(
                        "There is no method (get or is) on object %s for property %s",
                        $object::class,
                        $editableAttributeName,
                    ),
                );
                continue;
            }

            $value = $object->{$methodName}();

            if ($value instanceof UuidInterface) {
                $value = $this->serializer->uuidInterfaceToString($value);
            } elseif ($value instanceof DateTimeInterface) {
                $value = $this->serializer->dateTimeToString($value);
            } elseif ($value instanceof Money) {
                $value = $this->serializer->moneyFormatToString($value);
            } elseif ($editableAttributeName === "id" && $value === null) {
                // Whenever 'id' equals null skip it.
                $this->serializer->scalarValue($value);
                continue;
            } elseif ($value instanceof JsonSerializable || is_scalar($value) || $value === null) {
                // We accept simple values.
                $value = $this->serializer->scalarValue($value);
            } elseif (is_array($value)) {
                // If our value is an array and contains anything that is an instance of 'BaseObject'
                // Try to serialize that again. Please note that this is done by reference.
                foreach ($value as &$subValue) {
                    if (! ($subValue instanceof BaseObject)) {
                        continue;
                    }

                    $subValue = $this->prepareAddOrEditRequestForSerialization($subValue);
                }

                // Else do nothing.
                $value = $this->serializer->arrayValue($value);
            } elseif ($value instanceof SnelstartObject) {
                $editableSubAttributes = [];

                if ($value->getId() !== null) {
                    // Because it is an existing sub-object we only have to pass the id.
                    $editableSubAttributes = ["id"];
                }

                $value = $this->prepareAddOrEditRequestForSerialization($value, ...$editableSubAttributes);
            } elseif ($value instanceof BaseObject) {
                $value = $this->prepareAddOrEditRequestForSerialization($value);
            } else {
                throw new LogicException(
                    sprintf(
                        "You need to implement something to handle the serialization of '%s' (type: %s)",
                        $value::class,
                        gettype($value),
                    ),
                );
            }

            $serialize[$editableAttributeName] = $value;
        }

        return $serialize;
    }
}