<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Not secured', $crawler->filter('body')->text());
    }

    public function testApiOauth2Secured()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api');
        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
        $this->assertEquals('OAuth2 authentication required', $data['error_description']);
    }
}
