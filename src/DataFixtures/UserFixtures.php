<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('ru_RU');

        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setName($faker->name);
            $user->setEmail($faker->unique()->safeEmail);
            $user->setPhone($faker->unique()->numerify('+79#########'));

            $hashedPassword = $this->passwordHasher->hashPassword($user, 'password123');
            $user->setPassword($hashedPassword);

            $user->setRoles(['ROLE_USER']);

            $manager->persist($user);
        }

        $user = new User();
        $user->setName('ADMIN');
        $user->setEmail("admin@admin.com");
        $user->setPhone(+79112233344);

        $hashedPassword = $this->passwordHasher->hashPassword($user, '123456');
        $user->setPassword($hashedPassword);

        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);


        $manager->flush();
    }
}
