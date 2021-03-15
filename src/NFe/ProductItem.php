<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

use Illuminate\Support\Collection;
use RocheleEdenis\LaravelNotazz\Exceptions\RequiredFieldException;

class ProductItem extends Collection
{
    const REQUIRED_PROPERTIES = [
        'document_product_cod',
        'document_product_name',
        'document_product_qtd',
        'document_product_unitary_value',
    ];

    /**
     * * Associative collection for storing property values.
     *
     * @var Collection
     */
    public $content;

    public function __construct()
    {
        $this->content = collect();
    }

    /**
     * Cód do produto
     *
     * @param int $value
     */
    public function setDocumentProductCod(string $value)
    {
        $this->content->put('document_product_cod', $value);
    }

    /**
     * Cód fiscal do produto (código da logística)
     *
     * @param int $value
     */
    public function setDocumentProductTaxCod(int $value)
    {
        $this->content->put('document_product_tax_cod', (string) $value);
    }

    /**
     * Código de barras
     *
     * @param mixed $value
     */
    public function setDocumentProductEan($value)
    {
        $this->content->put('document_product_ean', (string) $value);
    }

    /**
     * Nome do produto
     *
     * @param string $value
     */
    public function setDocumentProductName(string $value)
    {
        $this->content->put('document_product_name', (string) $value);
    }

    /**
     * Quantidade de itens
     *
     * @param int $value
     */
    public function setDocumentProductQtd(int $value)
    {
        $this->content->put('document_product_qtd', (string) $value);
    }

    /**
     * Valor unitário do item
     *
     * @param float $value
     */
    public function setDocumentProductUnitaryValue(float $value)
    {
        $value = number_format($value, 2, '.', '');

        $this->content->put('document_product_unitary_value', $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_NCM
     *
     * @param int $value
     */
    public function setDocumentProductNcm(int $value)
    {
        $this->content->put('document_product_ncm', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_CEST
     *
     * @param int $value
     */
    public function setDocumentProductCest(int $value)
    {
        $this->content->put('document_product_cest', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_CFOP
     *
     * @param int $value
     */
    public function setDocumentProductCfop(int $value)
    {
        $this->content->put('document_product_cfop', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_DISCOUNT
     *
     * @param float $value
     */
    public function setDocumentProductDiscount(float $value)
    {
        $value = number_format($value, 2, '.', '');

        $this->content->put('document_product_discount', $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_ICMS_CST
     *
     * @param string $value
     */
    public function setDocumentProductIcmsCst(string $value)
    {
        $this->content->put('document_product_icms_cst', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_ICMS_ALIQUOTA
     *
     * @param float $value
     */
    public function setDocumentProductIcmsAliquota(float $value)
    {
        $value = number_format($value, 2, '.', '');

        $this->content->put('document_product_icms_aliquota', $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_IPI_CST
     *
     * @param int $value
     */
    public function setDocumentProductIpiCst(int $value)
    {
        $this->content->put('document_product_ipi_cst', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_IPI_ALIQUOTA
     *
     * @param float $value
     */
    public function setDocumentProductIpiAliquota(float $value)
    {
        $value = number_format($value, 2, '.', '');

        $this->content->put('document_product_ipi_aliquota', $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_PIS_CST
     *
     * @param int|string $value
     */
    public function setDocumentProductPiscst(string $value)
    {
        $this->content->put('document_product_pis_cst', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_PIS_ALIQUOTA
     *
     * @param float $value
     */
    public function setDocumentProductPisAliquota(float $value)
    {
        $value = number_format($value, 2, '.', '');

        $this->content->put('document_product_pis_aliquota', $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_COFINS_CST
     *
     * @param float $value
     */
    public function setDocumentProductCofinsCst(string $value)
    {
        $this->content->put('document_product_cofins_cst', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_COFINS_ALIQUOTA
     *
     * @param float $value
     */
    public function setDocumentProductCofinsAliquota(float $value)
    {
        $value = number_format($value, 2, '.', '');

        $this->content->put('document_product_cofins_aliquota', $value);
    }

    /**
     * Set the value of DOCUMENT_PRODUCT_OTHER_EXPENSES
     *
     * @param float $value
     */
    public function setDocumentProductOtherExpenses(float $value)
    {
        $value = number_format($value, 2, '.', '');

        $this->content->put('document_product_other_expenses', $value);
    }

    public function checkRequiredFiels()
    {
        foreach (self::REQUIRED_PROPERTIES as $property) {
            if (!$this->content->get($property)) {
                throw new RequiredFieldException("Propriedade $property é obrigatória");
            }
        }
    }
}
