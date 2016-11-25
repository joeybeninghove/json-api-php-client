<?php

namespace JsonApiClient;

use JsonApiClient\Resource;

class TestResource extends Resource
{
    public function __construct()
    {
        parent::__construct("http://api.site.com/v1/", "widgets");
    }
}
