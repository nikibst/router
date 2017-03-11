<?php

use PHPUnit\Framework\TestCase;

class DynamicTest extends TestCase
{
    /**
     * @dataProvider dynamicRouteProvider
     */
    public function testDynamicDataIntegrity($name, $route, $allowedMethods, $allowedSchemes, $allowedPorts)
    {
        $dynamicObj = new \Bastas\Router\Route\Dynamic($name, $route, $allowedMethods, $allowedSchemes, $allowedPorts);

        $this->assertEquals($name, $dynamicObj->getName());
        $this->assertEquals($route, $dynamicObj->getRoute());
        $this->assertEquals($allowedMethods, $dynamicObj->getAllowedMethods());
        $this->assertEquals($allowedSchemes, $dynamicObj->getAllowedSchemes());
        $this->assertEquals($allowedPorts, $dynamicObj->getAllowedPorts());
    }

    public function dynamicRouteProvider()
    {
        return [
            ['home', '/', ['GET', 'POST'], ['http', 'https'], [80, 843]],
        ];
    }
}
?>