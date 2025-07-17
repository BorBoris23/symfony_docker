## Управление миграциями базы данных

### Откат всех миграций (возврат к чистой базе)
```bash
dphp bin/console doctrine:migrations:migrate 0

dphp bin/console doctrine:migrations:migrate
