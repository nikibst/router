<?php

namespace Bastas\Router;

abstract class AbstractRoute
{
    const LITERAL_TYPE = 'Literal';
    const DYNAMIC_TYPE = 'Dynamic';

    private $name = [];
    private $route = [];
    private $allowedMethods = [];
    private $allowedPorts = [];
    private $allowedSchemes = [];

    /**
     * Route constructor.
     * @param $name
     * @param $route
     * @param array $allowedMethods
     * @param array $allowedPorts
     * @param array $allowedSchemes
     */
    public function __construct
    (
        $name,
        $route,
        array $allowedMethods = [],
        array $allowedSchemes = [],
        array $allowedPorts = []
    )
    {
        $this->name = $name;
        $this->route = $route;
        $this->allowedMethods = $allowedMethods;
        $this->allowedSchemes = $allowedSchemes;
        $this->allowedPorts = $allowedPorts;
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
