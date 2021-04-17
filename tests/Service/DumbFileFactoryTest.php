<?php

namespace App\Tests\Service;

use App\Service\DumbFileFactory;
use App\Service\FileStorage;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DumbFileFactoryTest extends WebTestCase
{
    private $fileStorage;
    private $testFiles = [];

    protected function setUp(): void
    {
        $this->fileStorage = $this->getFileStorageService();
    }

    public function testCreateIfNotExist(): void
    {
        $dumbFileFactory = new DumbFileFactory($this->fileStorage);

        $this->testFiles[] = $testFileName = 'test_' . time() . '_' . rand(100, 999) . '.txt';

        $this->assertFalse($this->fileStorage->exists($testFileName));

        $dumbFileFactory->createIfNotExist($testFileName);

        $this->assertTrue($this->fileStorage->exists($testFileName), 'DumbFileFactory not create file');

        $content = file_get_contents($this->fileStorage->getFilePath($testFileName));

        $this->assertNotEmpty($content);
    }

    private function getFileStorageService(): FileStorage
    {
        $client = self::createClient();
        $normalContainer = $client->getContainer();
        $specialContainer = $normalContainer->get('test.service_container');

        return $specialContainer->get(FileStorage::class);
    }

    protected function tearDown(): void
    {
        foreach($this->testFiles as $testFile) {
            $this->fileStorage->remove($testFile);
        }
    }
}
