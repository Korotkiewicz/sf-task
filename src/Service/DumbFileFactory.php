<?php

namespace App\Service;

class DumbFileFactory implements FileFactoryInterface
{
    private $fileStorage;

    public function __construct(FileStorage $fileStorage)
    {
        $this->fileStorage = $fileStorage;
    }

   
    /**
     * @throw \Exception
     */
    public function createIfNotExist(string $fileName): void
    {
        $filePath = $this->fileStorage->getFilePath($fileName);

        if (!$this->fileStorage->exists($filePath)) {
            $content = $this->createExampleContent($fileName);

            $this->fileStorage->filePutContent($filePath, $content);
        }
    }

    private function createExampleContent(string $fileName): array
    {
        $now = new \DateTime;

        return ['file_name' => $fileName, 'datetime' => $now->format('Y-m-d H:i:s')];
    }
}
