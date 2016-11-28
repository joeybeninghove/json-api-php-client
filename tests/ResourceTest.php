<?php

namespace JsonApiClient;

class ResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testHasId()
    {
        $resource = new Resource("foo", "bar");
        $this->assertFalse($resource->hasId());

        $resource->id = null;
        $this->assertFalse($resource->hasId());

        $resource->id = 0;
        $this->assertFalse($resource->hasId());

        $resource->id = "";
        $this->assertFalse($resource->hasId());

        $resource->id = "1";
        $this->assertTrue($resource->hasId());

        $resource->id = 1;
        $this->assertTrue($resource->hasId());
    }
}
