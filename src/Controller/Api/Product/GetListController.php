<?php

namespace App\Controller\Api\Product;

use App\DTO\Product\List\InputDTO;
use App\Service\Product\GetList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class GetListController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/api/products', name: 'app_api_product', methods: ['GET'])]
    public function __invoke(
        #[MapQueryString] InputDTO $dto,
        GetList $service,
    ): JsonResponse {
        return new JsonResponse($service->getList($dto));
    }
}
