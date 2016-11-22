<?php

namespace JsonApiClient;

class Url
{
    public static function getOne($resource)
    {
        return self::one($resource);
    }

    public static function getAll($resource)
    {
        return self::all($resource);
    }

    public static function create($resource)
    {
        return self::all($resource);
    }

    public static function update($resource)
    {
        return self::one($resource);
    }

    public static function delete($resource)
    {
        return self::one($resource);
    }

    public static function one($resource)
    {
        return $resource->baseUrl . $resource->url . "/" . $resource->id;
    }

    public static function all($resource)
    {
        return $resource->baseUrl . $resource->url;
    }
}
