<?php

namespace App\Tests\Widitrade\UrlShortener\Application\Find;

use App\Widitrade\UrlShortener\Application\Find\ShortUrlFinder;
use App\Widitrade\UrlShortener\Domain\ShortUrl\DTO\LongUrl;
use App\Widitrade\UrlShortener\Domain\ShortUrl\MakeUrlShorterInterface;
use Exception;
use PHPUnit\Framework\TestCase;

final class ShortUrlFinderTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testShortUrlFinder()
    {
        $urlShortenerMock = $this->createMock(MakeUrlShorterInterface::class);
        $urlShortenerMock->method('callApi')
            ->willReturn('https://tinyurl.com/abc123');

        $shortUrlFinder = new ShortUrlFinder($urlShortenerMock);
        $longUrl = new LongUrl('https://example.com');

        $shortUrl = $shortUrlFinder->__invoke($longUrl);

        $this->assertEquals('https://tinyurl.com/abc123', $shortUrl->getUrl());
    }

    public function testShortUrlFinderWithEmptyLongUrl()
    {
        $urlShortenerMock = $this->createMock(MakeUrlShorterInterface::class);

        $shortUrlFinder = new ShortUrlFinder($urlShortenerMock);

        $this->expectException(Exception::class);

        $longUrl = new LongUrl('');

        $shortUrlFinder->__invoke($longUrl);
    }

    public function testShortUrlFinderWithApiFailure()
    {
        $urlShortenerMock = $this->createMock(MakeUrlShorterInterface::class);
        $urlShortenerMock->method('callApi')
            ->willThrowException(new Exception('API error'));

        $shortUrlFinder = new ShortUrlFinder($urlShortenerMock);
        $longUrl = new LongUrl('https://example.com');

        $this->expectException(Exception::class);
        $shortUrlFinder->__invoke($longUrl);
    }
}