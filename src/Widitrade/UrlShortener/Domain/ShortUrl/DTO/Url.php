<?php

namespace App\Widitrade\UrlShortener\Domain\ShortUrl\DTO;

use Exception;

class Url
{
    private string $value;
    /**
     * @throws Exception
     */
    public function __construct(string $value) {
        $this->validateUrl($value);

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @throws Exception
     */
    private function validateUrl(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new Exception('The url is not valid');
        }
    }
}