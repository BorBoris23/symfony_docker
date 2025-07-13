<?php

namespace App\Controller\Api\Product;

use App\DTO\Product\Update\InputDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/api/products', name: 'app_api_update_product', methods: ['PUT'])]
    public function index(
        #[MapRequestPayload] InputDto $dto,
        UpdateManager $manager
    ): JsonResponse {
        return new JsonResponse($manager->update($dto));
    }
}
