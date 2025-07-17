<?php

namespace App\Infrastructure\Kafka\Consumer;

use App\Infrastructure\Kafka\Config\KafkaConsumerConfig;
use App\Infrastructure\Kafka\ProcessorServiceInterface;
use RdKafka\Conf;
use RdKafka\KafkaConsumer;
use RdKafka\Message;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;
use RdKafka\Exception;

abstract class AbstractConsumerService implements ConsumerServiceInterface
{
    private KafkaConsumer $consumer;

    /**
     * @throws Exception
     */
    public function __construct(
        protected readonly SerializerInterface $serializer,
        protected readonly ProcessorServiceInterface $processorService,
        private readonly KafkaConsumerConfig $config,
    ) {
        $conf = new Conf();
        $conf->set('metadata.broker.list', $this->config->brokers);
        $conf->set('group.id', $this->config->groupId);
        $conf->set('enable.auto.commit', $this->config->autoCommit);

        $this->consumer = new KafkaConsumer($conf);

        $this->consumer->subscribe([$this->config->topic]);
    }

    public function consume(OutputInterface $output): void
    {
        $output->writeln($this->config->waitingMessage);

        while (true) {
            $message = $this->consumer->consume(1000);
            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    $this->handleMessage($message, $output);
                    break;
                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    break;
                default:
                    $output->writeln("⚠️ Kafka error: {$message->errstr()}");
            }
        }
    }

    abstract protected function handleMessage(Message $message, OutputInterface $output): void;
}
