# Nova Dashboard Redirect

Simple package that allows to redirect nova user to any other route instead of homepage.

## Installation

```
composer require apimediaru/nova-dashboard-redirect
```

## Publishing vendor assets

```
php artisan vendor:publish --tag=nova-dashboard-redirect
```

## Configuration

Redirect configuration. Might be string what would be passed into Vue Router path option or an array or callable that returns route configuration.

```
'redirect' => '/resources/users',
```

Example of array route configuration:
```
'redirect' => [
  'name' => 'index',
  'params' => [
    'resourceName' => 'articles',
  ],
],
```

Exaple of callable:
```
'redirect' => '\SomeNamespace\SomeClass:getRouteConfiguration',
```
