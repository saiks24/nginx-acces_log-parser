<?php

namespace Saiks24\FileSystem;

interface FileInterface
{
    /** Получить следующую строку в файле
     * @return string|null
     */
    public function readNextLine() : ?string ;

    /** Вернуть - находится ли указатель на конце файла
     * @return bool
     */
    public function isAndOfFile() : bool;

    /** Получить размер файла
     * @return int
     */
    public function getFileSize() : int;
}