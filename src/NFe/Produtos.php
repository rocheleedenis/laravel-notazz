<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

use Illuminate\Support\Str;

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
        return $this->itens->sum(function ($item) {
            return $item->get('document_product_unitary_value') * $item->get('document_product_qtd');
        });
    }

    public function mount()
    {
        $itens = [];

        $itens['DOCUMENT_PRODUCT'] = $this->itens->map(function ($item) {
            return $item->mapWithKeys(function($value, $key) {
                return [Str::upper($key) => $value];
            })->toArray();
        })->toArray();

        return $itens;
    }
}
