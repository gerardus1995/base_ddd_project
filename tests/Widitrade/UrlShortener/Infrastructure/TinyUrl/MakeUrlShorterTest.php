<?php

namespace App\Tests\Widitrade\UrlShortener\Infrastructure\TinyUrl;

use App\Widitrade\UrlShortener\Infrastructure\TinyUrl\MakeUrlShorter;
use Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Exception\RedirectionException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class MakeUrlShorterTest extends TestCase
{
    public function testCallApiWithValidUrl()
    {
        $apiUrl = 'https://tinyurl.com/';
        $httpClient = $this->createMock(HttpClientInterface::class);
        $urlShortener = new MakeUrlShorter($apiUrl, $httpClient);

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getContent')->willReturn('https://tinyurl.com/short');
        $httpClient->method('request')->willReturn($response);

        $shortUrl = $urlShortener->callApi('https://example.com');

        $this->assertEquals('https://tinyurl.com/short', $shortUrl);
    }

    public function testCallApiWithEmptyUrl()
    {
        $apiUrl = 'https://tinyurl.com/';
        $httpClient = $this->createMock(HttpClientInterface::class);
        $urlShortener = new MakeUrlShorter($apiUrl, $httpClient);

        $shortUrl = $urlShortener->callApi('');

        $this->assertEquals('', $shortUrl);
    }
}






