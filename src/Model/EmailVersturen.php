<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

final class EmailVersturen extends BaseObject
{
    /**
     * Geeft aan (lezen/schrijven) of er email moet worden verstuurd.
     */
    private bool $shouldSend = false;

    /**
     * Het email adres waarnaar email moeten worden verstuurd.
     */
    private string|null $email = null;

    /**
     * Het (optionele) email adres waarnaar email moeten worden ge-Cc-eed.
     */
    private string|null $ccEmail = null;

    public static array $editableAttributes = [
        "shouldSend",
        "email",
        "ccEmail"
    ];

    public function __construct(bool $shouldSend, string|null $email = null, string|null $ccEmail = null)
    {
        $this->shouldSend = $shouldSend;
        $this->email = $email;
        $this->ccEmail = $ccEmail;
    }

    public function isShouldSend(): bool
    {
        return $this->shouldSend;
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function getCcEmail(): string|null
    {
        return $this->ccEmail;
    }
}