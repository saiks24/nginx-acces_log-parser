<?php


namespace Saiks24\Render;


class ConsoleRender implements RenderInterface
{

    public function render(array $parsedData): void
    {
        echo json_encode($parsedData,JSON_UNESCAPED_UNICODE) . PHP_EOL;
    }

}