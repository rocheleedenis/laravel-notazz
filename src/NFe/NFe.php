<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

class NFe
{
    /**
     * Referente à própria nota
     * @var Document
     */
    protected $document;
    /**
     * @var Destination
     */
    protected $destination;
    /**
     * @var Products
     */
    protected $products;
    /**
     * @var Products
     */
    private $method = 'create_nfe_55';

    /**
     * @param Destination
     * @param Document
     * @param Products
     */
    public function __construct(
        Destination $destination,
        Document $document,
        Products $products
    ) {
        $this->destination = $destination;
        $this->document    = $document;
        $this->products    = $products;
    }

    public function toArray()
    {
        return array_merge(
            ['METHOD' => $this->method],
            $this->destination->toArray(),
            $this->document->toArray(),
            $this->products->toArray()
        );
    }

    public function checkRequiredFiels()
    {
        $this->destination->checkRequiredFiels();
        $this->document->checkRequiredFiels();
        $this->products->checkRequiredFiels();

        return $this;
    }
}
