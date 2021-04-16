<?php

namespace App\Service;

class SimpleFileReader implements FileReaderInterface
{
    private $fileStorage;

    public function __construct(FileStorage $fileStorage)
    {
        $this->fileStorage = $fileStorage;
    }

    public function getFile(string $fileName): \SplFileInfo
    {
        return new \SplFileInfo($this->fileStorage->getFilePath($fileName));
    }
}