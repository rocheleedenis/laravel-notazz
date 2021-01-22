<?php

namespace RocheleEdenis\LaravelNotazz\Builders;

use RocheleEdenis\LaravelNotazz\NFe\NFe;
use RocheleEdenis\LaravelNotazz\Builders\DestinatarioBuilder;
use RocheleEdenis\LaravelNotazz\Builders\DocumentoBuilder;

class NotaFiscalBuilder
{
    protected $destinatario;
    protected $documento;
    protected $produtos;
    protected $current;
    protected $api_key;
    protected $external_id;
    protected $issuer_taxid;
    protected $sale_id;
    // protected $handler;

    public function __construct()
    {
        // $this->handler = new Client();

        $this->destinatario = new DestinatarioBuilder();
        $this->documento = new DocumentoBuilder();
        $this->produtos = new ProdutosBuilder();
        // $this->service = new ServiceBuilder();
        // $this->shipping = new ShippingBuilder();
    }

    // public function setRequestHandler($handler)
    // {
    //     $this->handler = $handler;
    //     return $this;
    // }

    public function apiKey(string $api_key)
    {
        $this->api_key = $api_key;

        return $this;
    }

    public function issuerTaxid($issuer_taxid)
    {
        $this->issuer_taxid = $issuer_taxid;

        return $this;
    }

    public function external_id($external_id)
    {
        $this->external_id = $external_id;

        return $this;
    }

    public function sale_id($sale_id)
    {
        $this->sale_id = $sale_id;

        return $this;
    }

    /*
     * Monta os métodos de set das classes automagicamente
     */
    public function __call($method, $args)
    {
        $arg = $args[0] ?? null;

        $target = $this->current;

        $this->$target->$method($arg);

        return $this;
    }

    public function destinatario()
    {
        $this->current = 'destinatario';

        return $this;
    }

    public function documento()
    {
        $this->current = 'documento';

        return $this;
    }

    public function produtos()
    {
        $this->current = 'produtos';

        return $this;
    }

    // ------------ x -------------
    public function isNFe(): bool
    {
        return (bool) $this->nfeType === 'service';
    }

    protected function getNFObject()
    {
        if ($this->isNFe()) {
            // return new NFSe(
            //     $this->destination->getInstance(),
            //     $this->document->getInstance(),
            //     $this->service->getInstance()
            // );
        }

        return new NFe(
            $this->destinatario->getInstance(),
            $this->documento->getInstance(),
            $this->produtos->getInstance()
            // $this->shipping->getInstance()
        );
    }

    public function mount()
    {
        return array_merge(
            [
                'API_KEY' => $this->api_key,
                'ISSUER_TAXID' => $this->issuer_taxid,
                'EXTERNAL_ID' => $this->external_id,
                'SALE_ID' => $this->sale_id,
            ],
            $this->getNFObject()->mount()
        );
    }
}
