<?php

namespace Saiks24\FileSystem;

use Saiks24\Exceptions\WrongLogFileExtension;

/** Класс предоставляет методы для работы с файлом
 * Class LogFile
 * @package Saiks24\FileSystem
 */
class LogFile implements FileInterface
{
    /** @var resource Дескриптор открытого файла */
    private $fileDescriptor;

    /** @var string Путь до файла */
    private $pathToFile;

    /**
     * LogFile constructor.
     * @param string $pathToFile
     * @throws WrongLogFileExtension
     */
    public function __construct(string $pathToFile)
    {
        if(!is_readable($pathToFile)) {
            throw new WrongLogFileExtension('Не удается получить информацию из указанного файла');
        }
        $this->pathToFile = $pathToFile;
        $this->fileDescriptor = fopen($this->pathToFile,'a+');
    }

    /**
     * @inheritDoc
     */
    public function readNextLine(): ?string
    {
        return fgets($this->fileDescriptor);
    }

    /**
     * @inheritDoc
     */
    public function isAndOfFile(): bool
    {
        return feof($this->fileDescriptor);
    }

    /**
     * @inheritDoc
     */
    public function getFileSize(): int
    {
        return filesize($this->pathToFile);
    }

}