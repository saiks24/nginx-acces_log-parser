<?php
require_once __DIR__.'/vendor/autoload.php';
use \Saiks24\FileSystem\LogFile;
use \Saiks24\Parser\NginxAccessLogParser;

$file = new LogFile(__DIR__.'/access_log');
$parser = new NginxAccessLogParser($file);

$result = $parser->parse();
var_dump($result);
