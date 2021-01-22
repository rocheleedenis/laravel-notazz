<?php

namespace RocheleEdenis\LaravelNotazz\Builders;

use \Illuminate\Support\Str;
use RocheleEdenis\LaravelNotazz\NFe\Produtos;
use RocheleEdenis\LaravelNotazz\NFe\ProdutoItem;
use RocheleEdenis\LaravelNotazz\Exceptions\MethodNotFoundException;

class ProdutosBuilder
{
    protected $produtos;
    protected $produtoItem;
    protected $adding;

    public function __construct()
    {
        $this->produtos = new Produtos();
    }

    public function __call(string $method, array $args)
    {
        $this->produtoItem = $this->makeProductItemInstance();

        $method = ucfirst(Str::camel($method));

        $method = "setDocumentProduct$method";

        if (false === method_exists($this->produtoItem, $method)) {
            throw new MethodNotFoundException("Method ($method) not found in class " . get_class($this->produtoItem));
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
        $this->produtos->addItem($this->produtoItem);
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

    protected function makeProductItemInstance(): ProdutoItem
    {
        if ($this->produtoItem instanceof ProdutoItem) {
            return $this->produtoItem;
        }

        return new ProdutoItem();
    }

    public function getInstance()
    {
        return $this->produtos;
    }
}
