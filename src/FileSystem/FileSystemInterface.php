<?php
namespace Saiks24\FileSystem;

interface FileSystemInterface
{
    public function isFileExist(FileInterface $file) : bool;
    public function isFileReadable(FileInterface $file) : bool;
    public function deleteFile(FileInterface $file) : bool;
    public function createFile(FileInterface $file) : bool;
}