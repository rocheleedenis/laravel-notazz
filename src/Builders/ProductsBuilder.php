<?php

namespace RocheleEdenis\LaravelNotazz\Builders;

use \Illuminate\Support\Str;
use RocheleEdenis\LaravelNotazz\Exceptions\MethodNotFoundException;
use RocheleEdenis\LaravelNotazz\NFe\ProductItem;
use RocheleEdenis\LaravelNotazz\NFe\Products;

class ProductsBuilder
{
    /**
     * @var Products
     */
    protected $products;
    /**
     * @var ProductItem
     */
    protected $produtoItem;
    /**
     * @var bool
     */
    protected $adding = false;

    public function __construct()
    {
        $this->products = app(Products::class);
    }

    public function __call(string $method, array $args)
    {
        $this->produtoItem = $this->makeProductItemInstance();

        $method = ucfirst(Str::camel($method));

        $method = "setDocumentProduct$method";

        if (false === method_exists($this->produtoItem, $method)) {
            throw new MethodNotFoundException("Método ($method) não encontrado na classe " . get_class($this->produtoItem));
        }

        $this->produtoItem->$method($args[0]);

        $this->setAdding(true);

        return $this;
    }

    public function add()
    {
        $this->setAdding(true);

        return $this;
    }

    public function save()
    {
        $this->setAdding(false);
        $this->products->addItem($this->produtoItem);
        $this->produtoItem = null;

        return $this;
    }

    protected function setAdding(bool $adding)
    {
        $this->adding = $adding;
    }

    protected function isAdding(): bool
    {
        return $this->adding;
    }

    protected function makeProductItemInstance(): ProductItem
    {
        if ($this->produtoItem instanceof ProductItem) {
            return $this->produtoItem;
        }

        return new ProductItem();
    }

    public function getInstance()
    {
        return $this->products;
    }

    public function sumItemsValue()
    {
        return $this->products->getSumItemsValue();
    }
}
