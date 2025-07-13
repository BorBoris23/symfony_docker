<?php

namespace App\Controller\Api\Registration;

use App\DTO\Registration\InputDto;
use RdKafka\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[Route('/api')]
class Controller extends AbstractController
{
    /**
     * @throws Exception
     * @throws ExceptionInterface
     */
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function invoke(
        #[MapRequestPayload] InputDto $dto,
        Manager $manager
    ): JsonResponse {
        return new JsonResponse($manager->register($dto));
    }
}
