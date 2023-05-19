<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthCheckController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['Health' => 'good']);
    }
}