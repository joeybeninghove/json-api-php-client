<?php

namespace JsonApiClient;

class Resource
{
    public $id;
    public $type;
    public $baseUrl;
    public $url;
    public $attributes = [];

    public static $username;
    public static $password;

    public function __construct($baseUrl, $url, $type)
    {
        $this->baseUrl = $baseUrl;
        $this->url = $url;
        $this->type = $type;
    }

    public function hasId()
    {
        return !empty($this->id);
    }

    public static function auth($username, $password="")
    {
        static::$username = $username;
        static::$password = $password;
    }

    public static function create($attributes=[])
    {
        $resource = new static();
        $resource->attributes = $attributes;
        $response = HTTP::post($resource);
        $json = json_decode($response->getBody(), true);

        return static::loadOne($json);
    } 

    public static function getAll()
    {
        $resource = new static();
        $response = HTTP::get($resource);
        $json = json_decode($response->getBody(), true);

        return static::loadAll($json);
    }

    public static function getOne($id)
    {
        $resource = new static();
        $resource->id = $id;
        $response = HTTP::get($resource);
        $json = json_decode($response->getBody(), true);

        return static::loadOne($json);
    }

    public static function update($id, $attributes=[])
    {
        $resource = new static();
        $resource->id = $id;
        $resource->attributes = $attributes;
        $response = HTTP::patch($resource);
        $json = json_decode($response->getBody(), true);

        return static::loadOne($json);
    }

    public static function delete($id)
    {
        $resource = new static();
        $resource->id = $id;
        HTTP::delete($resource);
    }

    public static function loadOne($json)
    {
        $resource = new static();
        $resource->id = $json["data"]["id"];
        $resource->type = $json["data"]["type"];
        $resource->attributes = $json["data"]["attributes"];
        return $resource;
    }

    public static function loadAll($json)
    {
        $resources = [];
        foreach ($json["data"] as $data) {
            $resource = new static();
            $resource->id = $data["id"];
            $resource->type = $data["type"];
            $resource->attributes = $data["attributes"];
            $resources[] = $resource;
        }
        return $resources;
    }

    public function toArray()
    {
        $array = [];

        if ($this->id)
            $array["data"]["id"] = $this->id;

        $array["data"]["type"] = $this->type;
        $array["data"]["attributes"] = $this->attributes;

        return $array;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
