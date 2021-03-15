<?php

namespace RocheleEdenis\LaravelNotazz\Builders;

use Illuminate\Support\Str;
use RocheleEdenis\LaravelNotazz\NFe\Document;
use RocheleEdenis\LaravelNotazz\Exceptions\MethodNotFoundException;

class DocumentBuilder
{
    protected $document;

    public function __construct()
    {
        $this->document = new Document();
    }

    public function __call(string $method, array $args)
    {
        $method = ucfirst(Str::camel($method));

        $method = "setDocument$method";

        if (false === method_exists($this->document, $method)) {
            throw new MethodNotFoundException("Method ($method) not found in class " . get_class($this->document));
        }

        $this->document->$method($args[0]);

        return $this;
    }

    public function getInstance()
    {
        return $this->document;
    }
}
