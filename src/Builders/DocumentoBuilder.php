<?php

namespace RocheleEdenis\LaravelNotazz\Builders;

use Illuminate\Support\Str;
use RocheleEdenis\LaravelNotazz\NFe\Documento;
use RocheleEdenis\LaravelNotazz\Exceptions\MethodNotFoundException;

class DocumentoBuilder
{
    protected $documento;

    public function __construct()
    {
        $this->documento = new Documento();
    }

    public function __call(string $method, array $args)
    {
        $method = ucfirst(Str::camel($method));

        $method = "setDocument$method";

        if (false === method_exists($this->documento, $method)) {
            throw new MethodNotFoundException("Method ($method) not found in class " . get_class($this->documento));
        }

        $this->documento->$method($args[0]);

        return $this;
    }

    public function getInstance()
    {
        return $this->documento;
    }
}
