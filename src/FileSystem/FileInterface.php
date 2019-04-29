<?php
namespace Saiks24\FileSystem;

interface FileInterface
{
    public function readNextLine() : ?string ;
    public function isAndOfFile() : bool;
    public function getFileSize() : int;
}