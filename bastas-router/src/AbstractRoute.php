<?php

namespace Bastas\Router;

abstract class AbstractRoute
{
    const LITERAL_TYPE = 'Literal';
    const DYNAMIC_TYPE = 'Dynamic';

    private $name = [];
    private $route = [];
    private $allowedMethods = ['POST', 'GET', 'PUT', 'PATCH', 'DELETE'];
    private $allowedPorts = [80, 443];
    private $allowedSchemes = ['http', 'https'];

    /**
     * Route constructor.
     * @param $name
     * @param $route
     * @param array $allowedMethods
     * @param array $allowedPorts
     * @param array $allowedSchemes
     */
    public function __construct($name, $route, $allowedMethods = null, $allowedSchemes = null, $allowedPorts = null)
    {
        $this->name = $name;
        $this->route = $route;

        if (null !== $allowedMethods) {
            $this->allowedMethods = $allowedMethods;
        }

        if (null !== $allowedSchemes) {
            $this->allowedSchemes = $allowedSchemes;
        }

        if (null !== $allowedPorts) {
            $this->allowedPorts = $allowedPorts;
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return array
     */
    public function getAllowedMethods()
    {
        return $this->allowedMethods;
    }

    /**
     * @return array
     */
    public function getAllowedPorts()
    {
        return $this->allowedPorts;
    }

    /**
     * @return mixed
     */
    public function getAllowedSchemes()
    {
        return $this->allowedSchemes;
    }
}
