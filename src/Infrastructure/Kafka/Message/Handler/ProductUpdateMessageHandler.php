<?php

namespace App\Infrastructure\Kafka\Message\Handler;

use App\Infrastructure\Kafka\Message\Command\Product\UpdateMessage;
use App\Infrastructure\Kafka\ProducerService;
use RdKafka\Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class ProductUpdateMessageHandler
{
    public function __construct(
        private ProducerService $producerService,
        private ProductKafkaDtoFactory $builder,
        private string $productTopic,
    ) {}

    /**
     * @throws Exception
     */
    public function __invoke(UpdateMessage $message): void
    {
        $dto = $this->builder->build($message);
        $this->producerService->produce($this->productTopic, $dto);
    }
}
