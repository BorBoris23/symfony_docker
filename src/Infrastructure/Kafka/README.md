# ▶️ Консьюмеры Kafka

# Консьюмер регистрации пользователей
dphp bin/console kafka:consume:user_registration

# Консьюмер обновления продуктов
dphp bin/console kafka:consume:product_update

# Консьюмер создания продуктов
dphp bin/console kafka:consume:product_create


# ▶️ Удаление топиков Kafka

docker exec -it symfony-docker-kafka-1 kafka-topics \
--bootstrap-server localhost:9092 \
--delete --topic product_create_notifications

docker exec -it symfony-docker-kafka-1 kafka-topics \
--bootstrap-server localhost:9092 \
--delete --topic product_update_notifications

docker exec -it symfony-docker-kafka-1 kafka-topics \
--bootstrap-server localhost:9092 \
--delete --topic user_registration_notifications


# ▶️ Создание топиков Kafka

docker exec -it symfony-docker-kafka-1 kafka-topics \
--bootstrap-server 127.0.0.1:9092 \
--create --topic product_create_notifications \
--partitions 1 --replication-factor 1

docker exec -it symfony-docker-kafka-1 kafka-topics \
--bootstrap-server 127.0.0.1:9092 \
--create --topic product_update_notifications \
--partitions 1 --replication-factor 1

docker exec -it symfony-docker-kafka-1 kafka-topics \
--bootstrap-server 127.0.0.1:9092 \
--create --topic user_registration_notifications \
--partitions 1 --replication-factor 1
