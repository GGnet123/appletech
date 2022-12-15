Собрать докер командой `docker-compose up --build -d`, все параметры среды лежат в .env, не обращяйте внимание на значение в файле, я скопировал докер все настройки с какого-то своего проекта со 2 курса

Зайти в контейнер пхп командой `docker-compose exec php-cli bash`
Прогнать команды `php init` `composer install` `php yii migrate`
Добавить домены `api.appletech.lcl` и `appletech.lcl` в **hosts**
Перейти в браузере в `http://appletech.lcl:<nginx_port>`