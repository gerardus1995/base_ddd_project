<?php

namespace App\Controller\api\Security;

use Symfony\Component\HttpFoundation\Request;

class ApiTokenAuthenticator
{
    public function supports(Request $request): bool
    {
        return $request->headers->has('Authorization')
            && str_starts_with($request->headers->get('Authorization'), 'Bearer ');
    }

    public function checkCredentials(Request $request): bool
    {
        $stack = [];
        $pairs = [
            ')' => '(',
            ']' => '[',
            '}' => '{',
        ];
        $input = $this->getCredentials($request);

        $length = strlen($input);

        for ($i = 0; $i < $length; $i++) {
            $char = $input[$i];

            if ($char === ')' || $char === ']' || $char === '}') {
                if (empty($stack) || $stack[count($stack) - 1] !== $pairs[$char]) {
                    return false;
                }
                array_pop($stack);
            } elseif ($char === '(' || $char === '[' || $char === '{') {
                $stack[] = $char;
            }
        }

        return empty($stack);
    }

    private function getCredentials(Request $request): string
    {
        $authorizationHeader = $request->headers->get('Authorization');

        return substr($authorizationHeader, 7);
    }
}