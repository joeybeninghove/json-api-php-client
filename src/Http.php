<?php

namespace JsonApiClient;

class HTTP
{
    public static function post($resource)
    {
        return self::request("POST", $resource);
    }

    public static function patch($resource)
    {
        return self::request("PATCH", $resource);
    }

    public static function get($resource)
    {
        return self::request("GET", $resource);
    }

    public static function delete($resource)
    {
        return self::request("DELETE", $resource);
    }

    public static function request($method, $resource)
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
            $url = Url::create($resource);
            $options["headers"]["Content-Type"] = "application/vnd.api+json";
            $options["json"] = $resource->toArray();
        case "PATCH":
            $url = Url::update($resource);
            $options["headers"]["Content-Type"] = "application/vnd.api+json";
            $options["json"] = $resource->toArray();
        case "GET":
            if ($resource->id)
                $url = Url::getOne($resource);
            else
                $url = Url::getAll($resource);
        case "DELETE":
            $url = Url::delete($resource);
        }

        $client = new \GuzzleHttp\Client();
        $response = $client->request($method, $url, $options);

        return $response;
    }
}
