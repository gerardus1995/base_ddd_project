<?php

namespace App\Tests\Widitrade\UrlShortener\Domain\ShortUrl\DTO;

use App\Widitrade\UrlShortener\Domain\ShortUrl\DTO\LongUrl;
use Exception;
use PHPUnit\Framework\TestCase;

class ShortUrlTest extends TestCase
{
    public function testShortUrlCreation()
    {
        $longUrl = new LongUrl('https://example.com');

        $this->assertEquals('https://example.com', $longUrl->getUrl()->__toString());
    }

    public function testShortUrlCreationWithEmptyUrl()
    {
        $this->expectException(Exception::class);
        $longUrl = new LongUrl('');
    }

    public function testShortUrlCreationWithInvalidUrlFormat()
    {
        $this->expectException(Exception::class);
        $longUrl = new LongUrl('example.com');
    }

    /**
     * @throws Exception
     */
    public function testShortUrlStaticCreationMethod()
    {
        $longUrl = LongUrl::create('https://example.com');

        $this->assertEquals('https://example.com', $longUrl->getUrl()->__toString());
    }
}