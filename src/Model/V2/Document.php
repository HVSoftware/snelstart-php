<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use InvalidArgumentException;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\SnelstartObject;
use SplFileObject;

use function base64_encode;

final class Document extends SnelstartObject
{
    /**
     * De inhoud van de bijlage.
     */
    protected string|null $content = null;

    /**
     * De public identifier van de gekoppelde parent.
     */
    protected UuidInterface|null $parentIdentifier = null;

    /**
     * De naam van de bijlage.
     */
    protected string|null $fileName = null;

    /**
     * De bijlage is alleen-lezen.
     */
    protected bool $readOnly;

    public static array $editableAttributes = [
        "id",
        "parentIdentifier",
        "content",
        "fileName",
    ];

    public function getContent(): string|null
    {
        return $this->content;
    }

    /**
     * @param string $content Should contain base64 encoded data
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getParentIdentifier(): UuidInterface|null
    {
        return $this->parentIdentifier;
    }

    public function setParentIdentifier(UuidInterface $parentIdentifier): self
    {
        $this->parentIdentifier = $parentIdentifier;

        return $this;
    }

    public function getFileName(): string|null
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function isReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public static function createFromFile(SplFileObject $file, UuidInterface $parentIdentifier): self
    {
        if (! $file->isReadable()) {
            throw new InvalidArgumentException("Given file is not readable");
        }

        return (new static())
            ->setFileName($file->getFilename())
            ->setParentIdentifier($parentIdentifier)
            ->setReadOnly(false)
            ->setContent(base64_encode($file->fread($file->getSize())));
    }
}