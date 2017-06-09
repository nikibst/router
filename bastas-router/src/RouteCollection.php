<?php

namespace Bastas\Router;

final class RouteCollection
{
    private $routeCollection = [];
    private $allowedMethods = ['POST', 'GET', 'PUT', 'PATCH', 'DELETE'];
    private $allowedPorts = [80, 443];
    private $allowedSchemes = ['http', 'https'];

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
                                        $routeTree['route_node']['allowed_methods'] : $this->allowedMethods;

                $allowedPorts = isset($routeTree['route_node']['allowed_ports']) ?
                                      $routeTree['route_node']['allowed_ports'] : $this->allowedPorts;

                $allowedSchemes = isset($routeTree['route_node']['allowed_schemes']) ?
                                        $routeTree['route_node']['allowed_schemes'] : $this->allowedSchemes;

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
