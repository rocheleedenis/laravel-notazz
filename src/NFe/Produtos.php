<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

use RocheleEdenis\LaravelNotazz\Resource;

class Produtos extends Resource
{
    /**
     * @var array
     */
    protected $document_product = [];

    /**
     * Adiciona produtos
     *
     * @param ProdutoItem
     */
    public function addItem(ProdutoItem $item)
    {
        $this->document_product[] = $item->toArray();
    }
}
