<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

final class EmailVersturen extends BaseObject
{
    /**
     * Geeft aan (lezen/schrijven) of er email moet worden verstuurd.
     *
     * @var bool
     */
    private $shouldSend = false;

    /**
     * Het email adres waarnaar email moeten worden verstuurd.
     *
     * @var string|null
     */
    private $email;

    /**
     * Het (optionele) email adres waarnaar email moeten worden ge-Cc-eed.
     *
     * @var string|null
     */
    private $ccEmail;

    public static $editableAttributes = [
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