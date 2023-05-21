<?php

namespace App\Tests\Widitrade\UrlShortener\Domain\ShortUrl\DTO;

use App\Widitrade\UrlShortener\Domain\ShortUrl\DTO\LongUrl;
use Exception;
use PHPUnit\Framework\TestCase;

class LongUrlTest extends TestCase
{
    public function testLongUrlCreation()
    {
        $longUrl = new LongUrl('https://example.com');

        $this->assertEquals('https://example.com', $longUrl->getUrl()->__toString());
    }

    public function testLongUrlCreationWithEmptyUrl()
    {
        $this->expectException(Exception::class);
        $longUrl = new LongUrl('');
    }

    public function testLongUrlCreationWithInvalidUrlFormat()
    {
        $this->expectException(Exception::class);
        $longUrl = new LongUrl('example.com');
    }

    /**
     * @throws Exception
     */
    public function testLongUrlStaticCreationMethod()
    {
        $longUrl = LongUrl::create('https://example.com');

        $this->assertEquals('https://example.com', $longUrl->getUrl()->__toString());
    }
}