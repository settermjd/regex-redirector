# Regex Redirector

This is a simple package that simplifies the process of performing redirects by searching and replacing a pattern within the URL, if present. 
It's not meant to be, in any way, sophisticated.

## Installing

To install the module, use Composer by running `composer require settermjd/regex-redirector`.

## Getting Started

The constructor takes two arguments:

1. An array. This is a simple key/value list of patterns to look for with patterns to replace
2. The currently requested URL. 

The package provides two functions: 

- `requiresRedirect()`: This tests if the requested URL requires a redirect
- `getRedirectUrl()`: Retrieves the URL that the current request should be redirected to

If you just want to test, use the first, if you want to redirect, use the second, which uses the first internally.

After initializing the object, pass the return value from `getRedirectUrl()` to PHP's [header](http://php.net/manual/de/function.header.php) function, as in the example below, and the request will be redirected.

```php
<?php

require_once('vendor/autoload.php');

$redirectList = [
    'configuration_server' => 'configuration/server'
];

$requestUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$redirector = new RegexRedirector\Redirector($redirectList, $requestUrl);

if ($redirector->requiresRedirect()) {
    header(sprintf('Location: %s', $redirector->getRedirectUrl()));
    exit;
}
``` 

## Running the Tests

To run the unit tests, run `composer test`.
