<?php


class TestAppClass extends \PHPUnit\Framework\TestCase
{

    /**
     * Проверить что класс приложения вызывает метод рендера
     */
    public function testThatOnRenderObjectCallMethodRender()
    {
        $app = new \Saiks24\App\Application();
        $renderMock = self::getMockBuilder(\Saiks24\Render\ConsoleRender::class)
            ->disableOriginalConstructor()
            ->getMock();
        $parserMock = self::getMockBuilder(\Saiks24\Parser\NginxAccessLogParser::class)
            ->disableOriginalConstructor()
            ->getMock();
        $parserMock->method('parse')->willReturn([]);

        $renderMock->expects(self::once())->method('render')->willReturn('');
        $app->run($parserMock,$renderMock);
    }

    /**
     * Проверить что класс приложения вызывает метод парсинга
     */
    public function testThatOnParserObjectCallMethodParser()
    {
        $app = new \Saiks24\App\Application();
        $renderMock = self::getMockBuilder(\Saiks24\Render\ConsoleRender::class)
            ->disableOriginalConstructor()
            ->getMock();
        $parserMock = self::getMockBuilder(\Saiks24\Parser\NginxAccessLogParser::class)
            ->disableOriginalConstructor()
            ->getMock();
        $renderMock->method('render')->willReturn('');

        $parserMock->expects(self::once())->method('parse')->willReturn([]);
        $app->run($parserMock,$renderMock);
    }

}