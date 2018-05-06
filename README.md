# test-task3

### Зависимости проекта
- docker >=17
- docker-compose
- свободный порт 8512

### Запуск:
1. Клонирование репозитория с подмодулями `git clone --recursive https://github.com/zakirovir6/test-task3.git`
2. `cd test-task3`
3. установка переменных окружения (параметры соединения с mysql и redis) `cp .env.sample .env`
4. сборка и запуск приложения `docker-compose up --build -d`
5. нужно дождаться, пока соберутся все зависимости composer и webpack, можно наблюдать в `docker-compose logs -f`
6. приложение будет доступно на [localhost:8512](http://127.0.0.1:8512)

### Описание сервисов из docker-compose.yml:
- **mysql** - база данных для хранения результатов расчета
- **redis** - используется как сервис очередей
- **php** - php-fpm
- **php-composer** - воркер для обновления зависимостей composer, проведения миграций и запуск консьюмера очереди
- **yarn-builder** - сборщик фронтенда
- **nginx** - веб-сервер
