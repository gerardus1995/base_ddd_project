<?php

namespace App\Widitrade\UrlShortener\Domain\ShortUrl;

interface MakeUrlShorterInterface
{
    public function callApi(string $url): string;
}