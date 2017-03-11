<?php

namespace Bastas\Router\Route;

use Bastas\Router\AbstractRoute;

final class Literal extends AbstractRoute
{

    public function __construct($name, $route, $allowedMethods = null, $allowedSchemes = null, $allowedPorts = null)
    {
        parent::__construct($name, $route, $allowedMethods, $allowedSchemes, $allowedPorts);
    }
}
