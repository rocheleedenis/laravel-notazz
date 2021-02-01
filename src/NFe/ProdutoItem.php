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
     * Get the value of DOCUMENT_PRODUCT_COD
     *
     * @return int
     */
    public function getDocumentProductCod()
    {
        return (string) $this->document_product_cod;
    }

    /**
     * Cód do produto
     *
     * @param int $document_product_cod
     */
    public function setDocumentProductCod(int $document_product_cod)
    {
        $this->collection->put('document_product_cod', (string) $document_product_cod);
    }

    /**
     * Get the value of DOCUMENT_PRODUCT_TAX_COD
     *
     * @return int
     */
    public function getDocumentProductTaxCod()
    {
        return (string) $this->document_product_tax_cod;
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
     * Get the value of DOCUMENT_PRODUCT_EAN
     *
     * @return string
     */
    public function getDocumentProductEan()
    {
        return (string) $this->document_product_ean;
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
     * Get the value of DOCUMENT_PRODUCT_NAME
     *
     * @return string
     */
    public function getDocumentProductName()
    {
        return (string) $this->document_product_name;
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
     * Get the value of DOCUMENT_PRODUCT_QTD
     *
     * @return int
     */
    public function getDocumentProductQtd()
    {
        return (string) $this->document_product_qtd;
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
     * Get the value of DOCUMENT_PRODUCT_UNITARY_VALUE
     *
     * @return float
     */
    public function getDocumentProductUnitaryValue()
    {
        return (string) $this->document_product_unitary_value;
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
     * Get the value of DOCUMENT_PRODUCT_NCM
     *
     * @return int
     */
    public function getDocumentProductNcm()
    {
        return (string) $this->document_product_ncm;
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
     * Get the value of DOCUMENT_PRODUCT_CEST
     *
     * @return int
     */
    public function getDocumentProductCest()
    {
        return (string) $this->document_product_cest;
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
     * Get the value of DOCUMENT_PRODUCT_CFOP
     *
     * @return int
     */
    public function getDocumentProductCfop()
    {
        return (string) $this->document_product_cfop;
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
     * Get the value of DOCUMENT_PRODUCT_DISCOUNT
     *
     * @return float
     */
    public function getDocumentProductDiscount()
    {
        return (string) $this->document_product_discount;
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
     * Get the value of DOCUMENT_PRODUCT_ICMS_CST
     *
     * @return int
     */
    public function getDocumentProductIcmsCst()
    {
        return $this->document_product_icms_cst;
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
     * Get the value of DOCUMENT_PRODUCT_ICMS_ALIQUOTA
     *
     * @return float
     */
    public function getDocumentProductIcmsAliquota()
    {
        return (string) $this->document_product_icms_aliquota;
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
     * Get the value of DOCUMENT_PRODUCT_IPI_CST
     *
     * @return int
     */
    public function getDocumentProductIpiCst()
    {
        return (string) $this->document_product_ipi_cst;
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
     * Get the value of DOCUMENT_PRODUCT_IPI_ALIQUOTA
     *
     * @return float
     */
    public function getDocumentProductIpiAliquota()
    {
        return (string) $this->document_product_ipi_aliquota;
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
     * Get the value of DOCUMENT_PRODUCT_PIS_CST
     *
     * @return string
     */
    public function getDocumentProductPisCst()
    {
        return (string) (string) $this->document_product_pis_cst;
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
     * Get the value of DOCUMENT_PRODUCT_PIS_ALIQUOTA
     *
     * @return float
     */
    public function getDocumentProductPisAliquota()
    {
        return (string) $this->document_product_pis_aliquota;
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
     * Get the value of DOCUMENT_PRODUCT_COFINS_CST
     *
     * @return string
     */
    public function getDocumentProductCofinsCst()
    {
        return (string) $this->document_product_cofins_cst;
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
     * Get the value of DOCUMENT_PRODUCT_COFINS_ALIQUOTA
     *
     * @return float
     */
    public function getDocumentProductCofinsAliquota()
    {
        return (string) $this->document_product_cofins_aliquota;
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
