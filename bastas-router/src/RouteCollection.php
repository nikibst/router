<?php

namespace Bastas\Router;

final class RouteCollection
{
    private $routeCollection = [];

    public function __construct($routesConfiguration)
    {
        foreach ($routesConfiguration as $routeTree) {
            $cnt = 0;
            $topDllElementName = '';

            $routeLinkedList = new RouteDoublyLinkedList();

            while (isset($routeTree['route_node'])) {
                $routeType = $routeTree['route_node']['type'];
                $routeName = $routeTree['route_node']['name'];
                $actualRoute = $routeTree['route_node']['route'];

                $allowedMethods = isset($routeTree['route_node']['allowed_methods']) ?
                                        $routeTree['route_node']['allowed_methods'] : null;

                $allowedPorts = isset($routeTree['route_node']['allowed_ports']) ?
                                      $routeTree['route_node']['allowed_ports'] : null;

                $allowedSchemes = isset($routeTree['route_node']['allowed_schemes']) ?
                                        $routeTree['route_node']['allowed_schemes'] : null;

                if ($cnt++ == 0) {
                    $topDllElementName = $actualRoute;
                }

                $routeLinkedList->pushRouteToList(
                    $routeType,
                    $routeName,
                    $actualRoute,
                    $allowedMethods,
                    $allowedPorts,
                    $allowedSchemes
                );

                $routeTree = $routeTree['route_node'];
            }

            $this->addToDllToCollection($topDllElementName, $routeLinkedList);
        }
    }

    private function addToDllToCollection($name, $dll)
    {
        $this->routeCollection[$name] = $dll;
    }

    public function getRouteCollection()
    {
        return $this->routeCollection;
    }
}
