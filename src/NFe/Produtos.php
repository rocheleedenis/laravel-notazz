<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

class Produtos
{
    /**
     * Collection object.
     *
     * @var Collection
     */
    protected $itens;

    public function __construct()
    {
        $this->itens = collect();
    }

    /**
     * Adiciona produtos
     *
     * @param ProdutoItem
     */
    public function addItem(ProdutoItem $item)
    {
        $this->itens->push($item->collection);
    }

    public function getSumItemsValue()
    {
        return $this->itens->sum('document_product_unitary_value');
    }

    public function mount()
    {
        $itens = [];

        $itens['document_product'] = $this->itens->map(function ($item) {
            return $item->toArray();
        })->toArray();

        return $itens;
    }
}
