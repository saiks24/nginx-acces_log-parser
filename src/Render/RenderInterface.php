<?php
namespace Saiks24\Render;

interface RenderInterface
{
    public function render(array $parsedData) : string ;
}