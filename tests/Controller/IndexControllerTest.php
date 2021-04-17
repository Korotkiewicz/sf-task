<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class IndexControllerTest extends WebTestCase
{
    const ACTION_HEALTH = 'health';

    public function testHomePageRedirect()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $baseUrl = $client->getRequest()->getUri();

        $this->assertTrue($client->getResponse()->isRedirect(), 'Home page should redirect');

        $this->assertResponseRedirects($baseUrl . self::ACTION_HEALTH, 302, 'Home page should redirect to health action');
    }

    public function testUnknownPage()
    {
        $client = static::createClient();

        $client->request('GET', '/unknown');

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

    public function testHealthAllowedMethod()
    {
        $client = static::createClient();

        $client->request('GET', self::ACTION_HEALTH);

        $this->assertEquals(Response::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode());
    }

    public function testHealthNotAllowedMethod()
    {
        $client = static::createClient();
        $methods = ['POST', 'PUT', 'PATCH', 'DELETE'];

        foreach ($methods as $method) {
            $client->request($method, self::ACTION_HEALTH);

            $this->assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $client->getResponse()->getStatusCode());
        }
    }

    public function testGetFileWithWrongParams()
    {
        $client = static::createClient();

        $client->request('GET', '/file');

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);

        $client->request('GET', '/file/test');

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);

        $client->request('GET', '/file/test.test');

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }


    public function testGetFileWithCorrectParams()
    {
        $client = static::createClient();

        $client->request('GET', '/file/test.txt');

        $this->assertResponseIsSuccessful();
    }

    public function testGetFileReturnCorrectFile()
    {
        $client = static::createClient();

        $now = new \DateTime;
        $fileName = 'test_' . $now->getTimestamp() . '.txt';
        $client->request('GET', '/file/' . $fileName);

        $binaryData = $client->getInternalResponse()->getContent();

        $this->assertNotEmpty($binaryData);

        $client->request('GET', '/file/' . $fileName);

        $secondBinaryData = $client->getInternalResponse()->getContent();

        $this->assertSame($binaryData, $secondBinaryData, 'Two request for same file should return same content.');

        $jsonDecodedData = json_decode($secondBinaryData, true);

        $this->assertNotNull($jsonDecodedData, 'Content is not proper json');


        $expectedData = ['file_name' => $fileName, 'datetime' => $now->format('Y-m-d H:i:s')];

        $this->assertEqualsCanonicalizing($expectedData, $jsonDecodedData, 'Content is not correct.');
    }
}