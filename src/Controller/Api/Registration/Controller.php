<?php

namespace App\Controller\Api\Registration;

use App\DTO\Registration\InputDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[Route('/api')]
class Controller extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function invoke(
        #[MapRequestPayload] InputDto $dto,
        Manager $manager
    ): JsonResponse {
        return $this->json(
            [
                'id' =>  $manager->register($dto)->getId(),
                'message' => 'Пользователь успешно зарегистрирован',
            ],
            Response::HTTP_CREATED,
        );
    }
}
