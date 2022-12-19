Создать `volume` командой `docker volume create --name=yc_postgres_database`
Собрать докер командой `docker-compose up --build -d`, все параметры среды лежат в .env, не обращяйте внимание на значения в файле, я скопировал все настройки с какого-то своего проекта со 2 курса
Настроить подключение к бд в common/main-local используя переменные с .env. 
Пример:

`'db' => [
    'class' => 'yii\db\Connection',
    'dsn' => "pgsql:host=$host;dbname=$dbname",
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
],`

Зайти в контейнер пхп командой `docker-compose exec php-cli bash`

Прогнать команды `php init` `composer install` `php yii migrate`

В app/.env прописать актуальный _BACKEND_URL_

Перейти в папку **app**

Установить **node_modules** командой `npm install`

Запустить фронт командой `npm run serve` 

Перейти в браузере в `http://localhost:8080`