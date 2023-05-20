<?php

namespace App\Controller\api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;

class BaseApiController extends AbstractController
{
    protected function validateMyRequest(Request $request, array $requirements): array
    {
        $parameters = json_decode($request->getContent(), true);
        $returnArray = [];

        $validator = Validation::createValidator();

        foreach ($requirements as $requirement) {
            $parameterKey = $requirement['value'];

            if ($requirement['required'] && !array_key_exists($parameterKey, $parameters)) {
                throw new BadRequestException();
            }

            $parameterValue = $parameters[$parameterKey] ?? null;
            $violations = $validator->validate($parameterValue, $requirement['constraints']);

            if (count($violations) > 0) {
                throw new BadRequestException();
            }

            $returnArray[$parameterKey] = $parameterValue ?? null;
        }

        return $returnArray;
    }
}