<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testHealthGetMethod()
    {
        $client = static::createClient();

        $client->request('GET', '/health');

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

    public function testHealthNotGetMethod()
    {
        $client = static::createClient();

        $client->request('POST', '/health');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());

        $client->request('PUT', '/health');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());

        $client->request('PATCH', '/health');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());

        $client->request('DELETE', '/health');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());

    }
}