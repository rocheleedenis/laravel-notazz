<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

use RocheleEdenis\LaravelNotazz\NFe\Documento;
use RocheleEdenis\LaravelNotazz\NFe\Produtos;
use RocheleEdenis\LaravelNotazz\NFe\Destinatario;

class NFe
{
    /**
     * Referente à própria nota
     * @var Documento
     */
    protected $documento;
    /**
     * @var Destinatario
     */
    protected $destinatario;
    /**
     * @var Produtos
     */
    protected $produtos;

    /**
     * @param Destinatario
     * @param Documento
     * @param Produtos
    //  * @param Shipping
     */
    public function __construct(
        Destinatario $destinatario,
        Documento $documento,
        Produtos $produtos
        // Shipping $shipping = null
    ) {
        $this->destinatario = $destinatario;
        $this->documento    = $documento;
        $this->produtos     = $produtos;
        // $this->shipping = $shipping;
    }

    public function mount()
    {
        return array_merge(
            ['METHOD' => 'create_nfe_55'],
            $this->destinatario->toArray(),
            $this->documento->toArray(),
            $this->produtos->toArray()
        );
    }
}
