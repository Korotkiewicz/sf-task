<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

class FileStorage
{
    private $directory;
    private $filesystem;

    public function __construct(Filesystem $filesystem, $defaultPath)
    {
        $this->filesystem = $filesystem;
        $this->directory = $defaultPath;

        if (!$filesystem->exists($this->directory)) {
            $filesystem->mkdir($this->directory, 0700);
        }
    }

    public function getFilePath(string $fileName): string
    {
        return $this->getPath() . $fileName;
    }

    public function getPath(): string
    {
        return $this->directory;
    }

    public function exists(string $fileName): bool
    {
        $filePath = $this->getFilePath($fileName);

        return $this->filesystem->exists($filePath);
    }

    public function filePutContent(string $fileName, mixed $content): void
    {
        $filePath = $this->getFilePath($fileName);

        $this->filesystem->dumpFile($filePath, json_encode($content));
    }
}