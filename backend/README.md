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

php artisan tinker

Category::factory()->count(10)->create()
Post::factory()->count(10)->create()
