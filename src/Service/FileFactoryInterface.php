<?php

namespace App\Service;

interface FileFactoryInterface
{
    /**
     * @throw \Exception
     */
    public function createIfNotExist(string $fileName): void;
}

