<?php

namespace App\Controller\api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HealthCheckController extends BaseApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(['Health' => 'Good']);
    }
}