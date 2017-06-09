**Description**

Route Match component that supports "Literal" & "Dynamic' routes.

**Usage:**

```
<?php

require "../vendor/autoload.php";

$configRoutes = [
    [
        'route_node' => [
            'type' => 'Literal',
            'name' => 'home',
            'route' => '/',
        ],
    ],
    [
        'route_node' => [
            'type' => 'Literal',
            'name' => 'route1',
            'route' => 'route-1',
            'route_node' => [
                'type' => 'Literal',
                'name' => 'route2',
                'route' => 'route-2',
            ]
        ],
    ],
    [
        'route_node' => [
            'type' => 'Literal',
            'name' => 'anotherRoute1',
            'route' => 'another-route-1',
            'route_node' => [
                'type' => 'Literal',
                'name' => 'anotherRoute2',
                'route' => 'another-route-2',
                'allowed_methods' => [],
                'route_node' => [
                    'type' => 'Dynamic',
                    'name' => 'id',
                    'route' => '/^[0-9]+$/',
                ]
            ]
        ],
    ],
];

$request = \Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routeMatch = new \Bastas\Router\RouteMatch();
var_dump($routeMatch->matchUri($request, new \Bastas\Router\RouteCollection($configRoutes)));
````