<?php

namespace Bastas\Router;

use Bastas\Router\Exception\RouteException;
use Bastas\Router\Route\Dynamic;
use Bastas\Router\Route\Literal;

final class RouteDoublyLinkedList extends \SplDoublyLinkedList
{
    public function pushRouteToList(
        $type,
        $name,
        $route,
        $allowedMethods = null,
        $allowedSchemes = null,
        $allowedPorts = null
    ) {
        $routeObj = null;

        if (AbstractRoute::LITERAL_TYPE === $type) {
            $routeObj = new Literal($name, $route, $allowedMethods, $allowedSchemes, $allowedPorts);
        } elseif (AbstractRoute::DYNAMIC_TYPE === $type) {
            $routeObj = new Dynamic($name, $route, $allowedMethods, $allowedSchemes, $allowedPorts);
        } else {
            throw new RouteException("There is no route type with name: " . $type);
        }

        $this->push($routeObj);

        return $this;
    }
}
