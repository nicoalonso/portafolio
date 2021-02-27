<?php declare(strict_types=1);

namespace App\Infrastructure\Controller\Concierto;

use App\Infrastructure\Controller\Identity\Result;
use App\Infrastructure\Controller\Identity\success;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ConciertoController
{
    public function __construct()
    {

    }

    public function create(Request $request): Response
    {
        $result = Result::success();
        return new JsonResponse($result);
    }
}