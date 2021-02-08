<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

use Illuminate\Support\Collection;

class ProdutoItem extends Collection
{
    /**
     * Collection object.
     *
     * @var Collection
     */
    public $collection;

    public function __construct()
    {
        $this->collection = collect();
    }

    public function fillRequired(int $cod, string $name, int $qtd, float $unitaryValue)
    {
        $this->document_product_cod           = $cod;
        $this->document_product_name          = $name;
        $this->document_product_qtd           = $qtd;
        $this->document_product_unitary_value = $unitaryValue;
    }

    /**
     * Cód do produto
     *
     * @param int $document_product_cod
     */
    public function setDocumentProductCod(string $document_product_cod)
    {
        $this->collection->put('document_product_cod', $document_product_cod);
    }

    /**
     * Cód fiscal do produto (código da logística)
     *
     * @param int $document_product_tax_cod
     */
    public function setDocumentProductTaxCod(int $document_product_tax_cod)
    {
        $this->collection->put('document_product_tax_cod', (string) $document_product_tax_cod);
    }

    /**
     * Código de barras
     *
     * @param mixed $document_product_ean
     */
    public function setDocumentProductEan($document_product_ean)
    {
        $this->collection->put('document_product_ean', (string) $document_product_ean);
    }

    /**
     * Nome do produto
     *
     * @param string $document_product_name
     */
    public function setDocumentProductName(string $document_product_name)
    {
        $this->collection->put('document_product_name', (string) $document_product_name);
    }

    /**
     * Quantidade de itens
     *
     * @param int $document_product_qtd
     */
    public function setDocumentProductQtd(int $document_product_qtd)
    {
        $this->collection->put('document_product_qtd', (string) $document_product_qtd);
    }

    /**
     * Valor unitário do item
     *
     * @param float $document_product_unitary_value
     */
    public function setDocumentProductUnitaryValue(float $document_product_unitary_value)
    {
        $this->collection->put('document_product_unitary_value', (string)$document_product_unitary_value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_NCM
     *
     * @param int $document_product_ncm
     */
    public function setDocumentProductNcm(int $document_product_ncm)
    {
        $this->collection->put('document_product_ncm', (string) $document_product_ncm);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_CEST
     *
     * @param int $document_product_cest
     */
    public function setDocumentProductCest(int $document_product_cest)
    {
        $this->collection->put('document_product_cest', (string) $document_product_cest);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_CFOP
     *
     * @param int $document_product_cfop
     */
    public function setDocumentProductCfop(int $document_product_cfop)
    {
        $this->collection->put('document_product_cfop', (string) $document_product_cfop);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_DISCOUNT
     *
     * @param float $document_product_discount
     */
    public function setDocumentProductDiscount(float $document_product_discount)
    {
        $this->collection->put('document_product_discount', (string) $document_product_discount);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_ICMS_CST
     *
     * @param string $document_product_icms_cst
     */
    public function setDocumentProductIcmsCst(string $document_product_icms_cst)
    {
        $this->collection->put('document_product_icms_cst', (string) $document_product_icms_cst);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_ICMS_ALIQUOTA
     *
     * @param float $document_product_icms_aliquota
     */
    public function setDocumentProductIcmsAliquota(float $document_product_icms_aliquota)
    {
        $this->collection->put('document_product_icms_aliquota', (string) $document_product_icms_aliquota);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_IPI_CST
     *
     * @param int $document_product_ipi_cst
     */
    public function setDocumentProductIpiCst(int $document_product_ipi_cst)
    {
        $this->collection->put('document_product_ipi_cst', (string) $document_product_ipi_cst);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_IPI_ALIQUOTA
     *
     * @param float $document_product_ipi_aliquota
     */
    public function setDocumentProductIpiAliquota(float $document_product_ipi_aliquota)
    {
        $this->collection->put('document_product_ipi_aliquota', (string) $document_product_ipi_aliquota);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_PIS_CST
     *
     * @param int|string $document_product_pis_cst
     */
    public function setDocumentProductPiscst(string $document_product_pis_cst)
    {
        $this->collection->put('document_product_pis_cst', (string) $document_product_pis_cst);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_PIS_ALIQUOTA
     *
     * @param float $document_product_pis_aliquota
     */
    public function setDocumentProductPisAliquota(float $document_product_pis_aliquota)
    {
        $this->collection->put('document_product_pis_aliquota', (string) $document_product_pis_aliquota);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_COFINS_CST
     *
     * @param float $document_product_cofins_cst
     */
    public function setDocumentProductCofinsCst(string $document_product_cofins_cst)
    {
        $this->collection->put('document_product_cofins_cst', (string) $document_product_cofins_cst);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_COFINS_ALIQUOTA
     *
     * @param float $document_product_cofins_aliquota
     */
    public function setDocumentProductCofinsAliquota(float $document_product_cofins_aliquota)
    {
        $this->collection->put('document_product_cofins_aliquota', (string) $document_product_cofins_aliquota);
    }
}
