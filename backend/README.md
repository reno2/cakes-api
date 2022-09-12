## Запуск rabbit  
`docker run --rm -it --hostname my-rabbit -p 15672:15672 -p 5672:5672 rabbitmq:3-management`

##Настройки 

`RABBITMQ_HOST=localhost` 

`RABBITMQ_PORT=5672`

`RABBITMQ_USER=guest`

`RABBITMQ_PASSWORD=guest`

`RABBITMQ_VHOST=/`

##Админка
http://localhost:15672/#/

Логин и пароль 
`guest`


main сервис выбрасывает событие а first сервис в провайдере событий обрабатывает его 

# Из tinker
php artisan tinker

Category::factory()->count(10)->create()
Post::factory()->count(10)->create()

# Artisan
php artisan db:seed

Нужно добавть в файл backend/database/seeders/DatabaseSeeder.php

Вызов команды создания

`Category::factory(10)->create();` 
`Post::factory(10)->create();`


# Авторизация

middleware
auth.role - Проверяем пользователея по токену
auth.role:admin,editor - Принимает массив ролей и проверяет ест лит они у пользователя 
