<?php

namespace App\Controller\api\v1;

use App\Controller\api\BaseApiController;
use App\Widitrade\Shared\Exceptions\AuthenticationFailedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ShortUrlsController extends BaseApiController
{
    /**
     * @throws AuthenticationFailedException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->authenticate($request);
        $params = $this->validateMyRequest($request, $this->requirements());

        return new JsonResponse(['Health' => 'bad']);
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