<?php

namespace Bastas\Router;

use Bastas\Router\Route\Dynamic;
use Bastas\Router\Route\Literal;
use Zend\Diactoros\ServerRequest;

final class RouteMatch
{
    public function matchUri(ServerRequest $request, array $routeCollection)
    {
        $segmentedUri = $this->extractSegmentedUri($request->getUri()->getPath());

        if (!isset($routeCollection[$segmentedUri[0]])) {
            return false;
        }

        if (($finalRouteElement = $this->routeMatch($routeCollection[$segmentedUri[0]], $segmentedUri))) {
            if ($this->methodMatch($request->getMethod(), $finalRouteElement->getAllowedMethods()) &&
                $this->schemeMatch($request->getUri()->getScheme(), $finalRouteElement->getAllowedSchemes())
            ) {
                return true;
            }
        }

        return false;
    }

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

    private function routeMatch($dllList, $segmentedUri)
    {
        $depthCnt = 0;
        $finalRouteElement = null;
        $dllList->rewind();

        while (isset($segmentedUri[$depthCnt])) {
            if ($dllList->current() instanceof Dynamic) {
                if (preg_match($dllList->current()->getRoute(), $segmentedUri[$depthCnt]) !== 1) {
                    return false;
                }
            } elseif ($dllList->current() instanceof Literal) {
                if ($dllList->current()->getRoute() !== $segmentedUri[$depthCnt]) {
                    return false;
                }
            }

            $depthCnt++;
            $finalRouteElement = $dllList->current();

            $dllList->next();
        }

        return $finalRouteElement;
    }
}
