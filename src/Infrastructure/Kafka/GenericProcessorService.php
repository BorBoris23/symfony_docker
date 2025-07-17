<?php

namespace App\Infrastructure\Kafka;

use App\DTO\KafkaMessageInterface;
use Symfony\Component\Serializer\SerializerInterface;

readonly class GenericProcessorService implements ProcessorServiceInterface
{
    public function __construct(private SerializerInterface $serializer) {}

    public function process(KafkaMessageInterface $dto): void
    {
        $json = $this->serializer->serialize($dto, 'json', [
            'json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        ]);

        echo "📦 [SIMULATED KAFKA] Send message:\n{$json}\n";
    }
}
