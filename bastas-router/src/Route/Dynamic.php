<?php

namespace Bastas\Router\Route;

use Bastas\Router\AbstractRoute;
use Bastas\Router\RouteInterface;

final class Dynamic extends AbstractRoute implements RouteInterface
{

    public function __construct($name, $route, $allowedMethods = null, $allowedSchemes = null, $allowedPorts = null)
    {
        parent::__construct($name, $route, $allowedMethods, $allowedSchemes, $allowedPorts);
    }

    public function stringMatch($route)
    {
        return preg_match($this->getRoute(), $route) === 1;
    }
}
