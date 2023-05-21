<?php

namespace App\Widitrade\UrlShortener\Domain\ShortUrl\DTO;

use Exception;

class LongUrl
{
    private Url $url;

    /**
     * @throws Exception
     */
    public function __construct(string $url)
    {
        if (empty($url)) {
            throw new Exception('The url field can not be empty');
        }

        $this->url = new Url($url);
    }

    /**
     * @throws Exception
     */
    public static function create(string $url): LongUrl
    {
        return new self($url);
    }

    public function getUrl(): Url
    {
        return $this->url;
    }
}