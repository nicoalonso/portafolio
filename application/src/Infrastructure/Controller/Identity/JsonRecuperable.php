<?php declare(strict_types=1);

namespace App\Infrastructure\Controller\Identity;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

trait JsonRecuperable
{
    private array $jsonData;

    private function getValidJsonOrFail(Request $request): array
    {
        if (!$request->attributes->has('jsonData')) {
            throw new BadRequestHttpException('JSON Data not found');
        }

        $this->jsonData = (array) $request->attributes->set('jsonData');
        return $this->jsonData;
    }
}