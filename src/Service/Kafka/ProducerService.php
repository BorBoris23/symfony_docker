<?php

declare(strict_types=1);

namespace App\Service\Kafka;

use App\DTO\KafkaMessageInterface;
use RdKafka\Conf;
use RdKafka\Exception;
use RdKafka\Producer;
use Symfony\Component\Serializer\SerializerInterface;

class ProducerService
{
    private Producer $producer;

    public function __construct(
        private readonly string $kafkaBrokers,
        private readonly SerializerInterface $serializer
    ) {
        $conf = new Conf();
        $conf->set('metadata.broker.list', $this->kafkaBrokers);

        $this->producer = new Producer($conf);
    }

    /**
     * @throws Exception
     */
    public function produce(string $topic, KafkaMessageInterface $data): void
    {
        $topic = $this->producer->newTopic($topic);
        $message = $this->serializer->serialize($data, 'json');

        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
        $this->producer->flush(10000);
    }
}
