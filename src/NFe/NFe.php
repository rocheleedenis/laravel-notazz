<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

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
     * @var Produtos
     */
    private $method = 'create_nfe_55';

    /**
     * @param Destinatario
     * @param Documento
     * @param Produtos
     */
    public function __construct(
        Destinatario $destinatario,
        Documento $documento,
        Produtos $produtos
    ) {
        $this->destinatario = $destinatario;
        $this->documento    = $documento;
        $this->produtos     = $produtos;
    }

    public function toArray()
    {
        return array_merge(
            ['METHOD' => $this->method],
            $this->destinatario->toArray(),
            $this->documento->toArray(),
            $this->produtos->toArray()
        );
    }
}
