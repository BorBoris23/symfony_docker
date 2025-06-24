<?php

namespace App\Controller\Api\Product;

use App\DTO\Product\Create\InputDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
final class CreateController extends AbstractController
{
    #[Route('/api/products', name: 'app_api_create_product', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] InputDto $dto,
        CreateManager $manager,
    ): JsonResponse {
        return new JsonResponse($manager->create($dto));
    }
}
