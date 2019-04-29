<?php


namespace Saiks24\FileSystem;


class LogFile implements FileInterface
{
    /** @var resource Дескриптор открытого файла */
    private $fileDescriptor;

    /** @var string Путь до файла */
    private $pathToFile;

    /**
     * LogFile constructor.
     * @param string $pathToFile
     */
    public function __construct(string $pathToFile)
    {
        $this->pathToFile = $pathToFile;
        $this->fileDescriptor = fopen($this->pathToFile,'a+');
    }

    public function readNextLine(): ?string
    {
        return fgets($this->fileDescriptor);
    }

    public function isAndOfFile(): bool
    {
        return feof($this->fileDescriptor);
    }

    public function getFileSize(): int
    {
        return filesize($this->pathToFile);
    }

}