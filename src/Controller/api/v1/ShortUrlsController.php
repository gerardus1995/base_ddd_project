<?php

namespace App\Controller\api\v1;

use App\Controller\api\BaseApiController;
use App\Resources\Security\ApiTokenAuthenticator;
use App\Widitrade\Shared\Exceptions\AuthenticationFailedException;
use App\Widitrade\UrlShortener\Application\Find\ShortUrlFinder;
use App\Widitrade\UrlShortener\Domain\ShortUrl\DTO\LongUrl;
use App\Widitrade\UrlShortener\Domain\ShortUrl\DTO\Url;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ShortUrlsController extends BaseApiController
{
    private ShortUrlFinder $finder;

    public function __construct(ShortUrlFinder $finder, ApiTokenAuthenticator $auth)
    {
        parent::__construct($auth);

        $this->finder = $finder;
    }

    /**
     * @throws AuthenticationFailedException
     * @throws Exception
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->authenticate($request);
        $params = $this->validateMyRequest($request, $this->requirements());

        $shortUrl = $this->finder->__invoke(LongUrl::create($params['url']));

        return new JsonResponse(['url' => $shortUrl->getUrl()->__toString()]);
    }

    private function requirements(): array
    {
        return [
            [
                'value' => 'url',
                'required' => true,
                'constraints' => [new NotBlank(), new Type('string')]
            ]
        ];
    }
}