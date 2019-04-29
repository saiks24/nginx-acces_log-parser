<?php

namespace Saiks24\App;

use Saiks24\Exceptions\WrongLogFileExtension;
use Saiks24\FileSystem\FileInterface;
use Saiks24\FileSystem\LogFile;
use Saiks24\Parser\LogParserInterface;
use Saiks24\Parser\NginxAccessLogParser;
use Saiks24\Render\ConsoleRender;
use Saiks24\Render\HttpRender;
use Saiks24\Render\RenderInterface;

/** Основной класс приложения
 * Class Application
 * @package Saiks24\App
 */
class Application
{

    /** @var self */
    private static $instance;

    /** Получить инстанс приложения
     * @return Application
     */
    public static function make()
    {
        if(empty(self::$instance)) {
            $instance = new Application();
            self::$instance = $instance;
            return self::$instance;
        }
        return self::$instance;
    }

    /** Запуск приложения
     * @param LogParserInterface $logParser
     * @param RenderInterface $render
     */
    public function run(LogParserInterface $logParser,RenderInterface $render) : void
    {
        $resultOfParsing = $logParser->parse();
        $render->render($resultOfParsing);
    }
}