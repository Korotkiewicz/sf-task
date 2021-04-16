<?php

namespace App\Service;

interface FileReaderInterface
{
    public function getFile(string $fileName): \SplFileInfo;
}
