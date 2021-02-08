<?php

namespace RocheleEdenis\LaravelNotazz\Builders;

use RocheleEdenis\LaravelNotazz\NFe\NFe;

class NotaFiscalBuilder
{
    /**
     * @var DestinatarioBuilder
     */
    protected $destinatario;
    /**
     * @var DocumentoBuilder;
     */
    protected $documento;
    /**
     * @var ProdutosBuilder
     */
    protected $produtos;
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

    public function __construct(string $nfeType)
    {
        $this->nfeType = $nfeType;

        $this->documento    = new DocumentoBuilder();
        $this->destinatario = new DestinatarioBuilder();
        $this->produtos     = new ProdutosBuilder();
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
    public function isNFSe(): bool
    {
        return (bool) $this->nfeType === 'service';
    }

    protected function getNFObject()
    {
        if ($this->isNFSe()) {
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
        $collection = collect([
            'API_KEY'      => $this->api_key,
            'ISSUER_TAXID' => $this->issuer_taxid,
            'EXTERNAL_ID'  => $this->external_id,
            'SALE_ID'      => $this->sale_id,
        ]);

        return array_merge(
            $collection->filter()->all(),
            $this->getNFObject()->mount()
        );
    }

    public function sumItemsValue()
    {
        return $this->produtos->sumItemsValue();
    }
}
