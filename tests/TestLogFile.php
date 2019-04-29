<?php
require_once __DIR__.'/../vendor/autoload.php';

class TestLogFile extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Saiks24\Exceptions\WrongLogFileExtension
     */
    public function testThatIfIncorrectFilePathThrowException()
    {
        $logFile = new \Saiks24\FileSystem\LogFile('wrong/path\/');
    }
}