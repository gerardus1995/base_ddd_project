<?php

namespace App\Tests\Widitrade\UrlShortener\Domain\ShortUrl\DTO;

use App\Widitrade\UrlShortener\Domain\ShortUrl\DTO\Url;
use Exception;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function testUrlCreation()
    {
        $url = new Url('https://example.com');

        $this->assertEquals('https://example.com', $url->__toString());
    }

    public function testUrlCreationWithInvalidUrl()
    {
        $this->expectException(Exception::class);
        $url = new Url('not-a-valid-url');
    }

    public function testUrlCreationWithEmptyUrl()
    {
        $this->expectException(Exception::class);
        $url = new Url('');
    }

    public function testUrlCreationWithSpecialCharacters()
    {
        $url = new Url('https://example.com/%23special%20character');

        $this->assertEquals('https://example.com/%23special%20character', $url->__toString());
    }
}