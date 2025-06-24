<?php

namespace App\Service;

use App\DTO\Registration\InputDto;
use App\DTO\Registration\OutputDto;
use App\Entity\User;
use App\Repository\UserRepository;

readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function getByCriteria(array $criteria): ?User
    {
        return $this->userRepository->findOneBy($criteria);
    }

    public function create(InputDto $dto): OutputDto
    {
        $user = $this->userRepository->create($dto);
        return new OutputDto(
            $user->getId(),
            $user->getName(),
            $user->getEmail(),
            $user->getPhone(),
        );
    }
}
