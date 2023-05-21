<?php

namespace App\Widitrade\UrlShortener\Application\Find;

use App\Widitrade\UrlShortener\Domain\ShortUrl\DTO\LongUrl;
use App\Widitrade\UrlShortener\Domain\ShortUrl\DTO\ShortUrl;
use App\Widitrade\UrlShortener\Domain\ShortUrl\DTO\Url;
use App\Widitrade\UrlShortener\Domain\ShortUrl\MakeUrlShorterInterface;
use Exception;

class ShortUrlFinder
{
    private MakeUrlShorterInterface $urlShortener;

    public function __construct(MakeUrlShorterInterface $tinyUrlShortener)
    {
        $this->urlShortener = $tinyUrlShortener;
    }

    /**
     * @throws Exception
     */
    public function __invoke(LongUrl $longUrl): ShortUrl
    {
        $shortUrl = $this->urlShortener->callApi($longUrl->getUrl()->__toString());

        return ShortUrl::create($shortUrl);
    }
}