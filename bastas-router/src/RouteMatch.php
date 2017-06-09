<?php

namespace Bastas\Router;

use Zend\Diactoros\ServerRequest;

final class RouteMatch
{
    private function methodMatch($requestMethod, $allowedMethods)
    {
        if (in_array($requestMethod, $allowedMethods)) {
            return true;
        }

        return false;
    }

    private function schemeMatch($requestMethod, $allowedSchemes)
    {
        if (in_array($requestMethod, $allowedSchemes)) {
            return true;
        }

        return false;
    }

    private function extractSegmentedUri($uriPath)
    {
        $segmentedUri = [$uriPath];

        if ($uriPath !== "/") {
            $segmentedUri = explode("/", rtrim($uriPath, "/"));
            array_shift($segmentedUri);
        }

        return $segmentedUri;
    }

    private function attributesMatch($request, $routeElement)
    {
        if (!$this->methodMatch($request->getMethod(), $routeElement->getAllowedMethods())) {
            return false;
        }

        if (!$this->schemeMatch($request->getMethod(), $routeElement->getAllowedMethods())) {
            return false;
        }

        return true;
    }

    private function pathMatch($dllList, $segmentedUri)
    {
        $depthCnt = 0;
        $finalRouteElement = null;
        $dllList->rewind();

        while (isset($segmentedUri[$depthCnt])) {
            if ($dllList->current() instanceof RouteInterface) {
                if(!$dllList->current()->stringMatch($segmentedUri[$depthCnt])) {
                    return null;
                }
            }

            $depthCnt++;
            $finalRouteElement = $dllList->current();

            $dllList->next();
        }

        return $finalRouteElement;
    }

    public function matchUri(ServerRequest $request, RouteCollection $routeCollection)
    {
        $collection = $routeCollection->getRouteCollection();
        $segmentedUri = $this->extractSegmentedUri($request->getUri()->getPath());

        if(isset($collection[$segmentedUri[0]])) {
            $finalRouteElement = $this->pathMatch($collection[$segmentedUri[0]], $segmentedUri);

            if (null !== $finalRouteElement) {
                if($this->attributesMatch($request, $finalRouteElement)) {
                    return true;
                }
            }
        }

        return false;
    }
}
