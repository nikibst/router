<?php

use PHPUnit\Framework\TestCase;

class LiteralTest extends TestCase
{
    /**
     * @dataProvider literalRouteProvider
     */
    public function testLiteralDataIntegrity($name, $route, $allowedMethods, $allowedSchemes, $allowedPorts)
    {
        $literalObj = new \Bastas\Router\Route\Literal($name, $route, $allowedMethods, $allowedSchemes, $allowedPorts);

        $this->assertEquals($name, $literalObj->getName());
        $this->assertEquals($route, $literalObj->getRoute());
        $this->assertEquals($allowedMethods, $literalObj->getAllowedMethods());
        $this->assertEquals($allowedSchemes, $literalObj->getAllowedSchemes());
        $this->assertEquals($allowedPorts, $literalObj->getAllowedPorts());
    }

    public function literalRouteProvider()
    {
        return [
            ['MyRoute', 'my-route', ['GET', 'POST'], ['http', 'https'], [80, 843]],
        ];
    }
}
?>