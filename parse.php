#! /usr/bin/php
<?php
/**
 * Скрипт для парсинга access_log файла веб сервера
 * Если обращение к скрипту произвелось из консоли - ожидается что в параметрах будет путь до файла логов
 * Если обращение к скрипту произвелось из http клиента - ожидается что в теле запроса будет путь до файла логов
 */

require_once __DIR__.'/vendor/autoload.php';

use \Saiks24\FileSystem\LogFile;
use \Saiks24\Parser\NginxAccessLogParser;
use \Saiks24\Render\ConsoleRender;
use \Saiks24\Render\HttpRender;

try {
    $app = Saiks24\App\Application::make();
    $pathToLogFile = '';
    switch (PHP_SAPI) {
        case 'cli':
            $pathToLogFile = $argv[1];
            $render = new ConsoleRender();
            break;
        default:
            $pathToLogFile = file_get_contents('php://input');
            $render = new HttpRender();
            break;
    }
    if(empty($pathToLogFile)) {
        throw new InvalidArgumentException('Не указан путь до файла с логами');
    }
    $logFile = new LogFile($pathToLogFile);
    $parser = new NginxAccessLogParser($logFile);

    $app->run($parser,$render);

} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
    exit(-1);
}
