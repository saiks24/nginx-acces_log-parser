<?php
require_once __DIR__.'/vendor/autoload.php';
use \Saiks24\FileSystem\LogFile;
use \Saiks24\Parser\NginxAccessLogParser;
use \Saiks24\Render\ConsoleRender;

$file = new LogFile(__DIR__.'/access_log');
$parser = new NginxAccessLogParser($file);
$render = new ConsoleRender();

$result = $parser->parse();

$render->render($result);