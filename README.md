1) Создать `volume` командой `docker volume create --name=yc_postgres_database`
2) Собрать докер командой `docker-compose up --build -d`, все параметры среды лежат в .env, не обращяйте внимание на значения в файле, я скопировал все настройки с какого-то своего проекта со 2 курса
3) Настроить подключение к бд в common/main-local используя переменные с .env. 
Пример:

`'db' => [
    'class' => 'yii\db\Connection',
    'dsn' => "pgsql:host=$host;dbname=$dbname",
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
],`

4) Зайти в контейнер пхп командой `docker-compose exec php-cli bash`

5) Прогнать команды `php init` `composer install` `php yii migrate`

6) В app/.env прописать актуальный _BACKEND_URL_

7) Перейти в папку **app**

8) Установить **node_modules** командой `npm install`

9) Запустить фронт командой `npm run serve` 

10) Перейти в браузере в `http://localhost:8080`