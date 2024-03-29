<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use RocheleEdenis\LaravelNotazz\Builders\NotaFiscalBuilder;

class NotaFiscalBuilderTest extends TestCase
{
    protected $notafiscal;

    public function setUp(): void
    {
        $this->notaFiscal = new NotaFiscalBuilder();
    }

    public function test_notazz_is_nfe()
    {
        $this->notaFiscal
            ->nfe()
            ->apiKey('123')
            ->destination()
                ->name('Marli Kamilly Daiane da Conceição')
                ->taxid('09889568020')
                ->taxtype('F')
                ->street('Rua dos Limões')
                ->number('735')
                ->district('Maria Goretti')
                ->city('Belo Horizonte')
                ->uf('MG')
                ->zipcode('31930425')
                ->email('marlikamilly@teste.com')
                ->phone(3128334142)
            ->document()
                ->basevalue(70.30)
                ->description('Venda')
                ->issueDate('2021-01-08 10:23:47')
            ->products()
                ->add()
                    ->cod(123)
                    ->name('Escova de dentes Cepacol')
                    ->qtd(2)
                    ->unitary_value(15.20)
                ->save()
                ->add()
                    ->cod(123)
                    ->name('Pano de prato para cozinha')
                    ->qtd(1)
                    ->unitaryValue(55.10)
                ->save();

        $this->assertTrue($this->notaFiscal->isNFe());
    }

    public function test_monta_array_da_nota_corretamente()
    {
        $this->notaFiscal->nfe()
            ->apiKey('123')
            ->destination()
                ->name('Marli Kamilly Daiane da Conceição')
                ->taxid('09889568020')
                ->taxtype('F')
                ->street('Rua dos Limões')
                ->number(735)
                ->district('Maria Goretti')
                ->city('Belo Horizonte')
                ->uf('MG')
                ->zipcode('31930-425')
                ->email('marlikamilly@teste.com')
                ->phone(3128334142)
            ->document()
                ->basevalue(70.30)
                ->description('Venda')
                ->issueDate('2021-01-08 10:23:47')
            ->products()
                ->add()
                    ->cod('00654')
                    ->name('Escova de dentes Cepacol')
                    ->qtd(2)
                    ->unitaryValue(15.20)
                ->save()
                ->add()
                    ->cod('00123')
                    ->name('Pano de prato para cozinha')
                    ->qtd(1)
                    ->unitaryValue(55.10)
                ->save();

        $resultado = $this->notaFiscal->toArray();

        $this->assertEqualsCanonicalizing($resultado, $this->respostaEsperada());
    }

    public function test_permite_montar_nota_em_etapas()
    {
        $this->notaFiscal
            ->nfe()
            ->apiKey('123');

        $this->notaFiscal
            ->destination()
                ->name('Marli Kamilly Daiane da Conceição')
                ->taxid('09889568020')
                ->taxtype('F')
                ->street('Rua dos Limões')
                ->number(735)
                ->district('Maria Goretti')
                ->city('Belo Horizonte')
                ->uf('MG')
                ->zipcode('31930-425')
                ->email('marlikamilly@teste.com')
                ->phone(3128334142);
        $this->notaFiscal
            ->document()
                ->basevalue(70.30)
                ->description('Venda')
                ->issueDate('2021-01-08 10:23:47');
        $this->notaFiscal
            ->products()
                ->add()
                    ->cod('00654')
                    ->name('Escova de dentes Cepacol')
                    ->qtd(2)
                    ->unitaryValue(15.20)
                ->save()
                ->add()
                    ->cod('00123')
                    ->name('Pano de prato para cozinha')
                    ->qtd(1)
                    ->unitaryValue(55.10)
                ->save();

        $resultado = $this->notaFiscal->toArray();

        $this->assertEqualsCanonicalizing($resultado, $this->respostaEsperada());
    }

    public function test_gera_valor_total_da_nota_baseado_nos_itens()
    {
        $this->notaFiscal
            ->nfe()
            ->products()
                ->add()
                    ->cod('00654')
                    ->name('Escova de dentes Cepacol')
                    ->qtd(2)
                    ->unitaryValue(15.20)
                ->save()
                ->add()
                    ->cod('00123')
                    ->name('Pano de prato para cozinha')
                    ->qtd(1)
                    ->unitaryValue(55.10)
                ->save()
                ->add()
                    ->cod('00987')
                    ->name('Cola branca escolar')
                    ->qtd(3)
                    ->unitaryValue(1.13)
                ->save();

        $this->assertEquals(88.89, $this->notaFiscal->sumItemsValue());
    }

    public function respostaEsperada()
    {
        return [
            'API_KEY'              => '123',
            'METHOD'               => 'create_nfe_55',
            'DESTINATION_NAME'     => 'Marli Kamilly Daiane da Conceição',
            'DESTINATION_TAXID'    => '09889568020',
            'DESTINATION_TAXTYPE'  => 'F',
            'DESTINATION_STREET'   => 'Rua dos Limões',
            'DESTINATION_NUMBER'   => '735',
            'DESTINATION_DISTRICT' => 'Maria Goretti',
            'DESTINATION_CITY'     => 'Belo Horizonte',
            'DESTINATION_UF'       => 'MG',
            'DESTINATION_ZIPCODE'  => '31930-425',
            'DESTINATION_PHONE'    => '3128334142',
            'DESTINATION_EMAIL'    => 'marlikamilly@teste.com',
            'DOCUMENT_BASEVALUE'   => '70.30',
            'DOCUMENT_DESCRIPTION' => 'Venda',
            'DOCUMENT_ISSUE_DATE'  => '2021-01-08 10:23:47',
            'DOCUMENT_PRODUCT'     => [
                [
                    'DOCUMENT_PRODUCT_COD'           => '00654',
                    'DOCUMENT_PRODUCT_NAME'          => 'Escova de dentes Cepacol',
                    'DOCUMENT_PRODUCT_QTD'           => '2',
                    'DOCUMENT_PRODUCT_UNITARY_VALUE' => '15.20'
                ], [
                    'DOCUMENT_PRODUCT_COD'           => '00123',
                    'DOCUMENT_PRODUCT_NAME'          => 'Pano de prato para cozinha',
                    'DOCUMENT_PRODUCT_QTD'           => '1',
                    'DOCUMENT_PRODUCT_UNITARY_VALUE' => '55.10'
                ],
            ],
        ];
    }
}
