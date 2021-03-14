<?php

namespace RocheleEdenis\LaravelNotazz\Builders;

use \Illuminate\Support\Str;
use RocheleEdenis\LaravelNotazz\Exceptions\MethodNotFoundException;
use RocheleEdenis\LaravelNotazz\NFe\Destinatario as DestinatarioNFSe;

class DestinatarioBuilder
{
    protected $destinatario;
    protected $lastCalled;

    public function __construct()
    {
        $this->destinatario = new DestinatarioNFSe();
    }

    public function __call(string $method, array $args)
    {
        $method = ucfirst(Str::camel($method));

        $method = "setDestination$method";

        if (false === method_exists($this->destinatario, $method)) {
            throw new MethodNotFoundException("Method ($method) not found in class " . get_class($this->destinatario));
        }

        $this->lastCalled = $method;

        $this->destinatario->$method($args[0]);

        return $this;
    }

    public function getInstance()
    {
        return $this->destinatario;
    }
}
