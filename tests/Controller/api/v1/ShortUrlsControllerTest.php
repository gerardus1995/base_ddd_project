<?php

namespace App\Tests\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShortUrlsControllerTest extends WebTestCase
{
    public function testGetShortUrlSuccessfully()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/v1/short-urls',
            [],
            [],
            ['HTTP_Authorization' => 'Bearer {}'],
            '{"url": "https://www.example.com"}'
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('url', $responseData);
    }

    public function testNotAuthorized()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/v1/short-urls',
            [],
            [],
            ['HTTP_Authorization' => 'Bearer {{}'],
            '{"url": "https://www.example.com"}'
        );

        $this->assertStringContainsString(
            'You are not allowed here',
            $client->getResponse()->getContent()
        );
    }

    public function testIncorrectBody()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/v1/short-urls',
            [],
            [],
            ['HTTP_Authorization' => 'Bearer []'],
            '{"hacker": "https://www.example.com"}'
        );

        $this->assertResponseStatusCodeSame(400);
    }
}