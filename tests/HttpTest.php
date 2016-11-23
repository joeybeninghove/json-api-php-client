<?php

namespace JsonApiClient;

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;

class HttpTest extends \PHPUnit_Framework_TestCase
{
    public function testGetOne()
    {
        $client = $this->createClient();
        $http = new Http($client);

        $resource = new TestResource();
        $resource->id = 123;
        $response = $http->get($resource);

        $this->assertEquals("http://api.site.com/v1/widgets/123",
            $response->getEffectiveUrl());
    }

    public function testGetAll()
    {
        $client = $this->createClient();
        $http = new Http($client);

        $resource = new TestResource();
        $response = $http->get($resource);

        $this->assertEquals("http://api.site.com/v1/widgets",
            $response->getEffectiveUrl());
    }

    public function testPost()
    {
        $client = $this->createClient();
        $http = new Http($client);

        $resource = new TestResource();
        $response = $http->post($resource);

        $this->assertEquals("http://api.site.com/v1/widgets",
            $response->getEffectiveUrl());
    }

    public function testPatch()
    {
        $client = $this->createClient();
        $http = new Http($client);

        $resource = new TestResource();
        $resource->id = 123;
        $response = $http->patch($resource);

        $this->assertEquals("http://api.site.com/v1/widgets/123",
            $response->getEffectiveUrl());
    }

    public function testDelete()
    {
        $client = $this->createClient();
        $http = new Http($client);

        $resource = new TestResource();
        $resource->id = 123;
        $response = $http->delete($resource);

        $this->assertEquals("http://api.site.com/v1/widgets/123",
            $response->getEffectiveUrl());
    }

    private function createClient()
    {
        $client = new Client();
        $mock = new Mock([
            new Response(200, ["X-Foo" => "Bar"])
        ]);
        $client->getEmitter()->attach($mock);

        return $client;
    }
}
