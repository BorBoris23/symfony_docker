<?php

namespace App\Infrastructure\Kafka\Message\Handler;

use App\Infrastructure\Kafka\Message\Command\Product\CreateMessage;
use App\Infrastructure\Kafka\ProducerService;
use RdKafka\Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class ProductCreateMessageHandler
{
    public function __construct(
        private ProducerService $producerService,
        private ProductKafkaDtoFactory $builder,
        private string $productTopic,
    ) {}

    /**
     * @throws Exception
     */
    public function __invoke(CreateMessage $message): void
    {
        $dto = $this->builder->build($message);
        $this->producerService->produce($this->productTopic, $dto);
    }
}
