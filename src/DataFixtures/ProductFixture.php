<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $product = new Product();
            $product->setName($faker->word);
            $product->setWeight($faker->numberBetween(1, 1000));
            $product->setHeight($faker->numberBetween(10, 200));
            $product->setWidth($faker->numberBetween(10, 200));
            $product->setLength($faker->numberBetween(10, 200));
            $product->setDescription($faker->text(200));
            $product->setCost($faker->numberBetween(100, 10000));
            $product->setTax($faker->numberBetween(0, 500));
            $product->setVersion(1);
            $product->setQuantity($faker->numberBetween(1, 500));
            $product->setArticle(strtoupper($faker->bothify('???-#####')));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
