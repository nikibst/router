<?php

namespace Bastas\Router\Route;

use Bastas\Router\AbstractRoute;
use Bastas\Router\RouteInterface;

final class Literal extends AbstractRoute implements RouteInterface
{

    public function __construct
    (
        $name,
        $route,
        array $allowedMethods = [],
        array $allowedSchemes = [],
        array $allowedPorts = []
    )
    {
        parent::__construct($name, $route, $allowedMethods, $allowedSchemes, $allowedPorts);
    }

    public function stringMatch($route)
    {
        return $this->getRoute() === $route;
    }
}
