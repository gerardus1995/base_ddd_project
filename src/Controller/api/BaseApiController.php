<?php

namespace App\Controller\api;

use App\Resources\Security\ApiTokenAuthenticator;
use App\Widitrade\Shared\Exceptions\AuthenticationFailedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;

class BaseApiController extends AbstractController
{
    private ApiTokenAuthenticator $auth;

    public function __construct(ApiTokenAuthenticator $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @throws AuthenticationFailedException
     */
    protected function authenticate(Request $request): void
    {
        if (!$this->auth->supports($request)) {
            throw new AuthenticationFailedException();
        }

        if (!$this->auth->checkCredentials($request)) {
            throw new AuthenticationFailedException();
        }
    }

    protected function validateMyRequest(Request $request, array $requirements): array
    {
        $parameters = json_decode($request->getContent(), true);
        $returnArray = [];

        $validator = Validation::createValidator();

        foreach ($requirements as $requirement) {
            $parameterKey = $requirement['value'];

            if (is_array($parameters) &&
                $requirement['required'] &&
                !array_key_exists($parameterKey, $parameters)
            ) {
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