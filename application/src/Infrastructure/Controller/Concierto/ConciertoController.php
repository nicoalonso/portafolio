<?php declare(strict_types=1);

namespace App\Infrastructure\Controller\Concierto;

use App\Application\Concierto\Creator\ConciertoCreate;
use App\Infrastructure\Controller\Identity\JsonRecuperable;
use App\Infrastructure\Controller\Identity\Result;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class ConciertoController
{
    use JsonRecuperable;

    private ConciertoCreate $creator;

    public function __construct(ConciertoCreate $creator)
    {
        $this->creator = $creator;
    }

    public function create(Request $request): Response
    {
        try {
            $createData = $this->getValidJsonOrFail($request);
            $this->creator->dispatch($createData);
            $result = Result::success();
        }
        catch (Throwable $e) {
            $result = Result::fails($e->getMessage());
        }
        return new JsonResponse($result);
    }
}