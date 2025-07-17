<?php

namespace App\Controller\Api\Product;

use App\DTO\Product\Deleted\InputDTO;
use App\Service\Product\Deleted;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
final class DeletedController extends AbstractController
{
    #[Route('/api/products', name: 'app_api_deleted_product', methods: ['DELETE'])]
    public function __invoke(
        #[MapRequestPayload] InputDto $dto,
        Deleted $service
    ): JsonResponse {
        return new JsonResponse($service->delete($dto));
    }
}
