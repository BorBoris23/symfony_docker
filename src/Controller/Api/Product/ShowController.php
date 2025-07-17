<?php

namespace App\Controller\Api\Product;

use App\DTO\Product\Show\InputDto;
use App\Service\Product\Show;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

class ShowController extends AbstractController
{
    #[Route('/api/products/show', name: 'app_api_product_show', methods: ['GET'])]
    public function __invoke(
        #[MapQueryString] InputDto $dto,
        Show $service
    ):JsonResponse {
        return new JsonResponse($service->show($dto));
    }
}
