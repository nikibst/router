<?php

use PHPUnit\Framework\TestCase;

class RouteDoublyLinkedListTest extends TestCase
{
    /**
     * @dataProvider expectLiteralDataProvider
     */
    public function testIsInstanceOfLiteral(
        $type,
        $name,
        $route,
        $allowedMethods = null,
        $allowedSchemes = null,
        $allowedPorts = null
    ) {
        $routeObj = (new \Bastas\Router\RouteDoublyLinkedList)->pushRouteToList(
            $type,
            $name,
            $route,
            $allowedMethods,
            $allowedSchemes,
            $allowedPorts
        );

        $routeObj->rewind();

        $this->assertInstanceOf(\Bastas\Router\Route\Literal::class, $routeObj->current());
    }

    public function expectLiteralDataProvider()
    {
        return [
            ['Literal', 'home', '/', ['GET', 'POST'], ['http', 'https'], [80, 843]],
        ];
    }

    /**
     * @dataProvider expectDynamicDataProvider
     */
    public function testIsInstanceOfDynamic(
        $type,
        $name,
        $route,
        $allowedMethods = null,
        $allowedSchemes = null,
        $allowedPorts = null
    ) {
        $routeObj = (new \Bastas\Router\RouteDoublyLinkedList)->pushRouteToList(
            $type,
            $name,
            $route,
            $allowedMethods,
            $allowedSchemes,
            $allowedPorts
        );

        $routeObj->rewind();

        $this->assertInstanceOf(\Bastas\Router\Route\Dynamic::class, $routeObj->current());
    }

    public function expectDynamicDataProvider()
    {
        return [
            ['Dynamic', 'home', '/', ['GET', 'POST'], ['http', 'https'], [80, 843]],
        ];
    }

    /**
     * @dataProvider expectRouteExceptionDataProvider
     */
    public function testIsRouteException(
        $type,
        $name,
        $route,
        $allowedMethods = null,
        $allowedSchemes = null,
        $allowedPorts = null
    ) {
        $this->expectException(\Bastas\Router\Exception\RouteException::class);

        (new \Bastas\Router\RouteDoublyLinkedList)->pushRouteToList(
            $type,
            $name,
            $route,
            $allowedMethods,
            $allowedSchemes,
            $allowedPorts
        );
    }

    public function expectRouteExceptionDataProvider()
    {
        return [
            ['UndefinedRouteType', 'home', '/', ['GET', 'POST'], ['http', 'https'], [80, 843]],
        ];
    }
}

?>