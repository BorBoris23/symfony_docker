<?php

namespace App\Repository;

use App\DTO\Registration\InputDto;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        ManagerRegistry $registry,
        UserPasswordHasherInterface $hasher
    ) {
        parent::__construct($registry, User::class);
        $this->hasher = $hasher;
    }

    public function create(InputDto $dto): User
    {
        $user = (new User())
            ->setName($dto->name)
            ->setEmail($dto->email)
            ->setPhone($dto->phone)
            ->setRoles(['ROLE_USER']);

        $user->setPassword($this->hasher->hashPassword($user, $dto->password));

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}


