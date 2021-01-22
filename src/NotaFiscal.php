<?php

namespace RocheleEdenis\LaravelNotazz;

use RocheleEdenis\LaravelNotazz\Client\Client;
use RocheleEdenis\LaravelNotazz\Builders\NotaFiscalBuilder;

class NotaFiscal extends NotaFiscalBuilder
{
    /**
     * @var string
     */
    protected $nfeType;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param string
     * @param mixed
     */
    public function __construct(string $nfeType = null)
    {
        parent::__construct();

        $this->nfeType = $nfeType;

        $this->client = new Client;
    }

    public function registrar()
    {
        return $this->client->request($this->mount());
    }
}
