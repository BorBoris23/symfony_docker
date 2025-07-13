<?php

namespace App\Controller\Api\Product;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ShowController extends AbstractController
{
    #[Route('/api/products/{id}', name: 'app_api_product_show', methods: ['GET'])]
    public function __invoke(
        Product $product,
        ShowManager $manager
    ):JsonResponse {
        return new JsonResponse($manager->show($product));
    }
}
