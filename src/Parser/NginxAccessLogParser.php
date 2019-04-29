<?php

namespace Saiks24\Parser;


use Saiks24\FileSystem\FileInterface;

/** Получить информацию по access_log веб сервера Nginx
 * Class NginxAccessLogParser
 * @package Saiks24\Parser
 */
class NginxAccessLogParser implements LogParserInterface
{
    /** @var string Регулярное выражение для парсинга логов */
    private $accessLogStringRegularExpression;

    /** @var int Количество запрошенных адресов */
    private $views;

    /** @var array Посещенные адреса ['url' => true] */
    private $visitedUrls;

    /** @var int Трафик в байтах */
    private $traffic;

    /** @var  array Запросы от поисковиков ['crawlerName' => count] */
    private $crawlers;

    /** @var array Возвращенные коды ответа ['code' => count] */
    private $statusCodes;

    /** @var FileInterface */
    private $logFile;

    /**
     * NginxAccessLogParser constructor.
     * @param FileInterface $logFile
     */
    public function __construct(FileInterface $logFile)
    {
        $this->accessLogStringRegularExpression = '/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3} - - \[(?P<dateandtime>\d{2}\/[a-zA-Z]{3}\/\d{4}:\d{2}:\d{2}:\d{2} (\+|\-)\d{4})\] ((\"(GET|POST) )(?P<url>.+)(HTTP\/[0,1]\.[0,1]")) (?P<statuscode>\d{3}) (?P<bytessent>\d+) (["](?P<refferer>(\-)|(.+))["]) (["](?P<useragent>.+)["])/m';
        $this->logFile = $logFile;
        $this->traffic = 0;
    }


    /**
     * @inheritDoc
     */
    public function parse(): ?array
    {
        while (!$this->logFile->isAndOfFile()) {
            $parsedInfoFromString = $this->parseString(
                $this->logFile->readNextLine()
            );
            if(empty($parsedInfoFromString)) {
                continue;
            }
            $this->updateResultOfLogParsing($parsedInfoFromString[0]);
        }
        return $this->compileResultOfParsing();
    }

    /** Получить агрегированную информацию по парсингу
     * @return array
     */
    private function compileResultOfParsing() : array
    {
        $logStatistics = [];
        $logStatistics['views'] = $this->views;
        $logStatistics['urls'] = count($this->visitedUrls);
        $logStatistics['traffic'] = $this->traffic;
        $logStatistics['crawlers'] = $this->crawlers;
        $logStatistics['statusCode'] = $this->statusCodes;
        return $logStatistics;
    }

    /** Добавить результат парсинга строки в промежуточные итоги выполнения
     * @param array $logFileStringInfo
     */
    private function updateResultOfLogParsing(array $logFileStringInfo)
    {
        $this->views++;
        $this->traffic += $logFileStringInfo['bytessent'];
        if(isset($this->visitedUrls[$logFileStringInfo['url']])) {
            $this->visitedUrls[$logFileStringInfo['url']]++;
        } else {
            $this->visitedUrls[$logFileStringInfo['url']] = 1;
        }

        if(isset($this->statusCodes[$logFileStringInfo['statuscode']])) {
            $this->statusCodes[$logFileStringInfo['statuscode']]++;
        } else {
            $this->statusCodes[$logFileStringInfo['statuscode']] = 1;
        }
        $crawler = $this->findCrawler($logFileStringInfo['useragent']);
        if(!empty($crawler)) {
            if(isset($this->crawlers)) {
                $this->crawlers[$crawler]++;
            } else {
                $this->crawlers[$crawler] = 1;
            }
        }
    }

    /** Определить поискового бота
     * @param string $client
     * @return string|null
     */
    private function findCrawler(string $client) : ?string
    {
        if(stripos($client,'Googlebot')) {
            return 'Google';
        }
        if(stripos($client,'bingbot')) {
            return 'Bing';
        }
        if(stripos($client,'Baidu')) {
            return 'Baidu';
        }
        return null;
    }

    /** Метод получает информацию из строки лог файла
     * @param string $iterString
     * @return array
     */
    private function parseString(string $iterString) : array
    {
        preg_match_all(
            $this->accessLogStringRegularExpression,
            $iterString,
            $parsedString,
        PREG_SET_ORDER,
        0
        );
        return $parsedString;
    }
}