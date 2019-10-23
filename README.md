# `Задача: `
Создать приложение по работе с финансовыми транзакциями.

Необходимо создать минимальный каркас приложения:
- Одна точка входа;
- Контроллеры (можно ограничиться одним);
- Сущности (тоже хватит одной);
- Сервис (работа с БД);

Приложение должно соответствовать конструкционному шаблону MVC.

В приложении должны присутствовать такие элементы как:
1) Авторизация (пользователь может быть заранее добавлен в БД)
2) Страница управления средствами аккаунта (содержит информацию о текущем балансе и Поле вывода средств с кнопкой "вывести" )

Необходимо представить, что начисление и раздача денег происходит с Вашей родной банковской карты, так что если где-то будут ошибки, то ошибки будут стоить денег.

Деньги должны быть заранее начислены на счет пользователя, то есть делать компоненты для начисления денег не нужно, только для списания (в пределах баланса пользователя).
В случае списания деньги не зачисляются на другой счет, списываем "вникуда".

Сессия должна быть неблокируемой, использовать session_write_close().

Решение не должно использовать очередей, достаточно использования PHP + Mysql и понимания работ транзакций и блокировок записи в БД.

PHP-фреймворки нельзя использовать. ORM'ы нельзя использовать (если используете, то внутри должен быть native SQL).

Использовать boostrap, jQuery и прочие инструменты для html-страницы – можно, но не обязательно, упор идёт именно на серверную часть. 
Клиент может быть сделан даже в виде файла index.php, где через echo выводится форма.
Делать html5-красивости и валидации на js нет необходимости, валидация должна быть на уровне php и базы.

Тестовое задание должно быть выложено на личный аккаунт на github.com (можно использовать другие подобные git-системы).  
  
---  
  

# `Решение: `
**Я реализовал задачу за почти 4 часа. Есть возможность открывать приложение в браузере, протестировать одновременную запись можно через консольную команду.**  

## Чтобы запустить проект нужно:
1. `Поднять докер (docker-compose up --build -d)`
2. `Можно настроить на локальное окружение без поднимания докера, для этого скопируйте .env_example в .env и укажите там ваши локальные зависимости` 
3. `Зайти в консоль php-cli (docker-compose exec php-cli bash)` 
4. `Запустить composer (composer install)`  
5. `Запустить миграцию (php commands/migrate.php)`

## Для теста: 

Открыть 2 консоли и в каждой запустить php commands/test.php он покажет текущую секунду и спросит в какую секунду запустить, указываем в обеих консолях одинаковые, чтобы запросы пошли одновременно.

Что можно улучшить:
1. **Внедрить DI**
2. **Более улучшенный роутер**
3. **Модели для работы с бд максимально отделить от сервисов**
4. **Убрать весь повторяющийся код, можно сделать SessionHelper, для более простой работы с сессией**
5. **Написать тесты** 
  
Спасибо за интересное задание! 
Надеюсь получить конструктивную критику!