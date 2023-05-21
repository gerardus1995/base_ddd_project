<?php

namespace App\Widitrade\UrlShortener\Infrastructure\TinyUrl;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MakeUrlShorter
{
    private HttpClientInterface $httpClient;
    private string $apiUrl;

    public function __construct(string $tinyUrlShortUrl)
    {
        $this->httpClient = HttpClient::create();
        $this->apiUrl = $tinyUrlShortUrl;
    }

    public function callApi(string $url): ?string
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                $this->apiUrl . $url
            );

            return $response->getContent();
        } catch (TransportExceptionInterface |
        ClientExceptionInterface |
        RedirectionExceptionInterface |
        ServerExceptionInterface $e) {
            // here we would log the message to the desired service
            return $e->getMessage();
        }
    }
}