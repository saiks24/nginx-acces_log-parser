<?php

namespace Saiks24\Parser;

/** Интерфейс парсинга логов
 * Interface LogParserInterface
 * @package Saiks24\Parser
 */
interface LogParserInterface
{
    /** Получить результат парсинга log файла
     * @return array|null
     */
    public function parse() : ?array ;
}