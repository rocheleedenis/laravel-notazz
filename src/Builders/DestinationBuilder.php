<?php

namespace RocheleEdenis\LaravelNotazz\Builders;

use \Illuminate\Support\Str;
use RocheleEdenis\LaravelNotazz\Exceptions\MethodNotFoundException;
use RocheleEdenis\LaravelNotazz\NFe\Destination as DestinationNFSe;

class DestinationBuilder
{
    protected $destination;
    protected $lastCalled;

    public function __construct()
    {
        $this->destination = new DestinationNFSe();
    }

    public function __call(string $method, array $args)
    {
        $method = ucfirst(Str::camel($method));

        $method = "setDestination$method";

        if (false === method_exists($this->destination, $method)) {
            throw new MethodNotFoundException("Method ($method) not found in class " . get_class($this->destination));
        }

        $this->lastCalled = $method;

        $this->destination->$method($args[0]);

        return $this;
    }

    public function getInstance()
    {
        return $this->destination;
    }
}
