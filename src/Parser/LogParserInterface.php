<?php
namespace Saiks24\Parser;

use Saiks24\FileSystem\FileInterface;

interface LogParserInterface
{
    public function parse() : ?array ;
}