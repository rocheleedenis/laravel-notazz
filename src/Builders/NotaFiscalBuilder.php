<?php

namespace RocheleEdenis\LaravelNotazz\Builders;

use RocheleEdenis\LaravelNotazz\NFe\NFe;

class NotaFiscalBuilder
{
    /**
     * @var DestinationBuilder
     */
    protected $destination;
    /**
     * @var DocumentBuilder;
     */
    protected $document;
    /**
     * @var ProductsBuilder
     */
    protected $products;
    /**
     * Entidade de interação atual
     *
     * @var string
     */
    protected $current;
    /**
     * @var string
     */
    protected $api_key;
    /**
     * @var string
     */
    protected $external_id;
    /**
     * @var string
     */
    protected $issuer_taxid;
    /**
     * @var string
     */
    protected $sale_id;
    /**
     * Nota fiscal montada
     *
     * @var array
     */
    protected $nota;

    public function __construct(string $nfeType = null)
    {
        $this->nfeType = $nfeType;

        $this->document    = new DocumentBuilder();
        $this->destination = new DestinationBuilder();
        $this->products    = new ProductsBuilder();
    }

    /**
     * Monta os métodos de set das classes automagicamente
     *
     * @param string $method
     * @param string $args
     * @return $this
     */
    public function __call($method, $args)
    {
        $arg = $args[0] ?? null;

        $target = $this->current;

        $this->$target->$method($arg);

        return $this;
    }

    /**
     * Define o tipo da nota fiscal
     *
     * @param string $api_key
     * @return $this
     */
    public function nfe()
    {
        $this->nfeType = 'produto';

        return $this;
    }

    /**
     * Chave de api fornecida pelo Notazz.
     *
     * @param string $api_key
     * @return $this
     */
    public function apiKey(string $api_key)
    {
        $this->api_key = $api_key;

        return $this;
    }

    /**
     * CPF ou CNPJ do emitente (não documentado)
     *
     * @param string $issuer_taxid
     * @return $this
     */
    public function issuerTaxid(string $issuer_taxid)
    {
        $this->issuer_taxid = $issuer_taxid;

        return $this;
    }

    /**
     * ID do sistema para consultar a nota posteriormente
     *
     * @param string $external_id
     * @return $this
     */
    public function externalId(string $external_id)
    {
        $this->external_id = $external_id;

        return $this;
    }

    /**
     * ID da venda
     *
     * @param string $sale_id
     * @return $this
     */
    public function saleId(string $sale_id)
    {
        $this->sale_id = $sale_id;

        return $this;
    }

    public function destination()
    {
        $this->current = 'destination';

        return $this;
    }

    public function document()
    {
        $this->current = 'document';

        return $this;
    }

    public function products()
    {
        $this->current = 'products';

        return $this;
    }

    // ------------ x -------------
    public function isNFe()
    {
        return $this->nfeType === 'produto';
    }

    protected function getNFObject()
    {
        if ($this->isNFe()) {
            return new NFe(
                $this->destination->getInstance(),
                $this->document->getInstance(),
                $this->products->getInstance()
                // $this->shipping->getInstance()
            );
        }

        // return new NFSe(
        //     $this->destination->getInstance(),
        //     $this->document->getInstance(),
        //     $this->service->getInstance()
        // );
    }

    public function toArray()
    {
        $singleAttributes = collect([
            'API_KEY'      => $this->api_key,
            'ISSUER_TAXID' => $this->issuer_taxid,
            'EXTERNAL_ID'  => $this->external_id,
            'SALE_ID'      => $this->sale_id,
        ])->filter()->all();

        return array_merge($singleAttributes, $this->getNFObject()->toArray());
    }

    public function sumItemsValue()
    {
        return $this->products->sumItemsValue();
    }

    public function checkRequiredFiels()
    {
        $this->getNFObject()->checkRequiredFiels();
    }
}
