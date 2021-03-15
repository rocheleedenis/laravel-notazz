<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use RocheleEdenis\LaravelNotazz\Builders\ProductsBuilder;
use RocheleEdenis\LaravelNotazz\Exceptions\RequiredFieldException;

class ProductsTest extends TestCase
{
    public function test_monta_produtos_corretamente()
    {
        $produtos = app(ProductsBuilder::class)
            ->add()
                ->cod('000123')
                ->name('Escova de dentes Cepacol')
                ->qtd(2)
                ->unitaryValue(15.20)
                ->ncm(123)
                ->ncm(123456)
                ->cest(2805900)
                ->cfop(5101)
                ->discount(2.00)
                ->icmsCst(102)
                ->cofinsCst(99)
                ->ipiCst(99)
                ->pisCst(99)
                ->ipiAliquota(0)
                ->icmsAliquota(0)
                ->pisAliquota(0)
                ->cofinsAliquota(0)
                ->otherExpenses(0)
            ->save();

        $esperado = [
            'DOCUMENT_PRODUCT' => [
                [
                    'DOCUMENT_PRODUCT_COD'             => '000123',
                    'DOCUMENT_PRODUCT_NAME'            => 'Escova de dentes Cepacol',
                    'DOCUMENT_PRODUCT_QTD'             => '2',
                    'DOCUMENT_PRODUCT_UNITARY_VALUE'   => '15.20',
                    'DOCUMENT_PRODUCT_NCM'             => '123456',
                    'DOCUMENT_PRODUCT_CEST'            => '2805900',
                    'DOCUMENT_PRODUCT_CFOP'            => '5101',
                    'DOCUMENT_PRODUCT_DISCOUNT'        => '2.00',
                    'DOCUMENT_PRODUCT_ICMS_CST'        => '102',
                    'DOCUMENT_PRODUCT_IPI_CST'         => '99',
                    'DOCUMENT_PRODUCT_PIS_CST'         => '99',
                    'DOCUMENT_PRODUCT_COFINS_CST'      => '99',
                    'DOCUMENT_PRODUCT_ICMS_ALIQUOTA'   => '0.00',
                    'DOCUMENT_PRODUCT_IPI_ALIQUOTA'    => '0.00',
                    'DOCUMENT_PRODUCT_PIS_ALIQUOTA'    => '0.00',
                    'DOCUMENT_PRODUCT_COFINS_ALIQUOTA' => '0.00',
                    'DOCUMENT_PRODUCT_OTHER_EXPENSES'  => '0.00',
                ]
            ]
        ];

        $this->assertEqualsCanonicalizing(
            $esperado,
            $produtos->getInstance()->toArray()
        );
    }

    public function test_verifica_falta_de_campos_obrigatorios_ao_adicionar_item()
    {
        $this->expectException(RequiredFieldException::class);

        app(ProductsBuilder::class)
            ->add()
                ->cod('000123')
                ->name('Escova de dentes Cepacol')
                ->unitaryValue(15.20)
            ->save();
    }
}
