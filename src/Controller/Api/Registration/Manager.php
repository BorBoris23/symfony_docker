<?php

namespace App\Controller\Api\Registration;

use App\DTO\Registration\InputDto;
use App\DTO\Registration\OutputDto;
use App\Service\UserService;

class Manager
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(InputDto $dto): OutputDto
    {
        return $this->userService->create($dto);
    }
}
