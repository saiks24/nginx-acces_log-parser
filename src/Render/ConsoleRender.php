<?php

namespace Saiks24\Render;

/** Отображает результат парсинга в консоль
 * Class ConsoleRender
 * @package Saiks24\Render
 */
class ConsoleRender implements RenderInterface
{

    /**
     * @inheritDoc
     */
    public function render(array $parsedData): void
    {
        echo json_encode($parsedData,JSON_UNESCAPED_UNICODE) . PHP_EOL;
    }

}