# JsonApiClient

This library is an opinionated, resource-based JSON API client for PHP that strives to adhere to the offical [JSON API 1.0 spec](http://jsonapi.org).

## Requirements

* PHP 5.4 or later
* [Guzzle](https://github.com/guzzle/guzzle) (auto-included if using Composer)

## Composer

You can install it via [Composer](https://getcomposer.org).  Run the following
command:

```bash
composer require cloudswipe/json-api-php-client
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Usage

### Define a resource
* `baseUrl` is specified as the root URL used when interacting with the API.
* `url` is the specific part of the URL for the current resource
* `type` is the [JSON API type](http://jsonapi.org/format/#document-resource-objects) for the current resource

```php
use JsonApiClient\Resource;

class Invoice extends Resource
{
    public function __construct()
    {
        parent::__construct(
            "https://api.site.com/v1/", // base URL
            "invoices", // resource URL
            "invoice" // type
        )
    }
}
```

### Set up HTTP Authentication
The `username` is required, but the `password` is optional and defaults to blank.
```php
Resource::auth("jdoe", "secret");
```

#### API Key example
If you're using a typical API key over HTTP Authentication, here is an example
of using a base class to abstract that away.
```php
class Base extends Resource
{
    public function __construct($url, $type)
    {
        parent::__construct("http://api.site.come/v1/", $url, $type);
    }

    public static function setApiKey($apiKey)
    {
        parent::auth($apiKey);
    }
}

class Invoice extends Base
{
    public function __construct()
    {
        parent::__construct("invoices", "invoice");
    }
}

Base::setApiKey("some secret key");
$invoices = Invoice::getAll();
```

### Create a resource
```php
$invoice = Invoice::create([
    "description" => "T-Shirt",
    "total" => 10.95
]);
```

### Update a resource
Update a resource with partial updates.  This uses the `PATCH` method under the
hood.  See [Where's PUT?](http://jsonapi.org/faq/#wheres-put).
```php
$invoice = Invoice::update("invoice_123", [
    "description" => "Blue T-Shirt"
]);
```

### Get a single resource
```php
$invoice = Invoice::getOne("invoice_123");
```

### Get all resources
```php
$invoices = Invoice::getAll();
```

### Delete a resource
```php
Invoice::delete("invoice_123");
```
