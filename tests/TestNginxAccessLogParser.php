<?php


class TestNginxAccessLogParser extends \PHPUnit\Framework\TestCase
{

    /**
     * Проверка на то что парсер валидирует то что файл - пустой
     */
    public function testThatOnFileObjectCallMethodEndOfFile()
    {
        $fileMock = self::getMockBuilder(\Saiks24\FileSystem\LogFile::class)
            ->disableOriginalConstructor()
            ->getMock();
        $fileMock->expects(self::atLeast(1))->method('isAndOfFile')->willReturn(true);

        $parser = new \Saiks24\Parser\NginxAccessLogParser($fileMock);

        $parser->parse();
    }

    /**
     * Проверить что парсер пытается считывать информацию из файла если он не пустой
     */
    public function testThatIfNotEmptyFileCalledMethodGetStringOnFileObject()
    {
        $fileMock = self::getMockBuilder(\Saiks24\FileSystem\LogFile::class)
            ->disableOriginalConstructor()
            ->getMock();
        $fileMock->method('isAndOfFile')->willReturn(false);
        $fileMock->expects(self::atLeast(1))
            ->method('readNextLine')
            ->willThrowException(new Exception('test'));

        $parser = new \Saiks24\Parser\NginxAccessLogParser($fileMock);

        $parser->parse();
    }
}