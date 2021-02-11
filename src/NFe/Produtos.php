<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

use Illuminate\Support\Str;

class Produtos
{
    /**
     * Associative collection for storing property values.
     *
     * @var Collection
     */
    protected $content;

    public function __construct()
    {
        $this->content = collect();
    }

    /**
     * Adiciona produtos
     *
     * @param ProdutoItem
     */
    public function addItem(ProdutoItem $item)
    {
        $item->checkRequiredFiels();

        $this->content->push($item->content);
    }

    public function getSumItemsValue()
    {
        return $this->content->sum(function ($item) {
            return $item->get('document_product_unitary_value') * $item->get('document_product_qtd');
        });
    }

    public function toArray()
    {
        $items = $this->content->map(function ($item) {
                return $item->mapWithKeys(function($value, $key) {
                    return [Str::upper($key) => $value];
                })->toArray();
            })->toArray();

        return [ 'DOCUMENT_PRODUCT' => $items];
    }
}
