<?php declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Infrastructure\Controller\Identity\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    public function home(): Response
    {
        $result = Result::success();
        return new JsonResponse($result);
    }
}