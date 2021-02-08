<?php

namespace RocheleEdenis\LaravelNotazz;

use RocheleEdenis\LaravelNotazz\Client\Client;
use RocheleEdenis\LaravelNotazz\Builders\NotaFiscalBuilder;

class Notazz
{
    /**
     * @var NotaFiscalBuilder
     */
    protected $nota;
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param string
     * @param mixed
     */
    public function __construct()
    {
        $this->client = new Client;
    }

    public function registrar()
    {
        return $this->client->request($this->nota->mount());
    }

    public function nfe()
    {
        $this->nota = new NotaFiscalBuilder('produto');

        return $this->nota;
    }

    public function nfeToArray()
    {
        return $this->nota->mount();
    }
}
