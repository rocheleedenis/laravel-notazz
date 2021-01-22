<?php

namespace RocheleEdenis\LaravelNotazz\v2\NFe;

use RocheleEdenis\LaravelNotazz\v2\Resource;

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
