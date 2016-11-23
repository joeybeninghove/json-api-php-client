<?php

namespace JsonApiClient;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    public function testGetOneReturnsUrl()
    {
        $resource = new TestResource();
        $resource->id = 123;

        $expected = $resource->baseUrl . $resource->url . "/" . $resource->id;
        $this->assertEquals($expected, Url::getOne($resource));
    }

    public function testGetAllReturnsUrl()
    {
        $resource = new TestResource();

        $expected = $resource->baseUrl . $resource->url;
        $this->assertEquals($expected, Url::getAll($resource));
    }

    public function testCreateReturnsUrl()
    {
        $resource = new TestResource();

        $expected = $resource->baseUrl . $resource->url;
        $this->assertEquals($expected, Url::create($resource));
    }

    public function testUpdateReturnsUrl()
    {
        $resource = new TestResource();
        $resource->id = 123;

        $expected = $resource->baseUrl . $resource->url . "/" . $resource->id;
        $this->assertEquals($expected, Url::update($resource));
    }

    public function testDeleteReturnsUrl()
    {
        $resource = new TestResource();
        $resource->id = 123;

        $expected = $resource->baseUrl . $resource->url . "/" . $resource->id;
        $this->assertEquals($expected, Url::delete($resource));
    }
}
