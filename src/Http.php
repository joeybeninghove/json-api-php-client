<?php

namespace JsonApiClient;

use GuzzleHttp\Client;

class Http
{
    public $client;

    public function __construct($client=null)
    {
        if ($client)
            $this->client = $client;
        else
            $this->client = new Client();
    }

    public function post($resource)
    {
        $options = $this->options("POST", $resource);
        return $this->request("POST", Url::create($resource), $options);
    }

    public function patch($resource)
    {
        $options = $this->options("PATCH", $resource);
        return $this->request("PATCH", Url::update($resource), $options);
    }

    public function delete($resource)
    {
        $options = $this->options("DELETE", $resource);
        return $this->request("DELETE", Url::delete($resource), $options);
    }

    public function get($resource)
    {
        $options = $this->options("GET", $resource);
        if ($resource->hasId())
            return $this->request("GET", Url::getOne($resource), $options);
        else
            return $this->request("GET", Url::getAll($resource), $options);
    }

    public function request($method, $url, $options=[])
    {
        $request = $this->client->createRequest($method, $url, $options);

        return $this->client->send($request);
    }

    public function options($method, $resource)
    {
        $class = get_class($resource);
        $options = [
            "auth" => [$class::$username, $class::$password],
            "headers" => [
                "Accept" => "application/vnd.api+json",
            ]
        ];

        switch ($method) {
        case "POST":
            $options["headers"]["Content-Type"] = "application/vnd.api+json";
            $options["json"] = $resource->toArray();
        case "PATCH":
            $options["headers"]["Content-Type"] = "application/vnd.api+json";
            $options["json"] = $resource->toArray();
        }

        return $options;
    }
}
