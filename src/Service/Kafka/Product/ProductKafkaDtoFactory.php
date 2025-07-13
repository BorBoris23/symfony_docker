<?php

namespace App\Service\Kafka\Product;

use App\DTO\Product\KafkaMessageDTO;
use App\DTO\Product\MeasurementsDTO;
use App\Message\Command\Product\MessageInterface;

readonly class ProductKafkaDtoFactory
{
    public function build(MessageInterface $message): KafkaMessageDTO
    {
        $product = $message->getProduct();

        $measurements = new MeasurementsDTO(
            $product->getWeight(),
            $product->getHeight(),
            $product->getWidth(),
            $product->getLength()
        );

        return new KafkaMessageDTO(
            id: $product->getId(),
            name: $product->getName(),
            measurements: $measurements,
            description: $product->getDescription(),
            cost: $product->getCost(),
            tax: $product->getTax(),
            version: $product->getVersion()
        );
    }
}
