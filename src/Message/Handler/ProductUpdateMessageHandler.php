<?php

namespace App\Message\Handler;

use App\Message\Command\Product\UpdateMessage;
use App\Service\Kafka\ProducerService;
use App\Service\Kafka\Product\ProductKafkaDtoFactory;
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
