<?php

namespace App\Message\Handler;

use App\Message\Command\Product\CreateMessage;
use App\Service\Kafka\ProducerService;
use App\Service\Kafka\Product\ProductKafkaDtoFactory;
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
