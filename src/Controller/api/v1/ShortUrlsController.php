<?php

namespace App\Controller\api\v1;

use App\Controller\api\BaseApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ShortUrlsController extends BaseApiController
{
    public function __invoke(Request $request): JsonResponse
    {
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