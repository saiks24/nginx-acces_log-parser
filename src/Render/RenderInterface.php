<?php

namespace Saiks24\Render;

/** Интерфейс вывода результатов парсинга
 * Interface RenderInterface
 * @package Saiks24\Render
 */
interface RenderInterface
{
    /** Вывести информацию в поток вывода
     * @param array $parsedData
     */
    public function render(array $parsedData) : void ;
}