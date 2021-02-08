<?php

use PHPUnit\Framework\TestCase;
use RocheleEdenis\LaravelNotazz\Notazz;

class NotaFiscalNFeTest extends TestCase
{
    protected $notafiscal;

    public function setUp(): void
    {
        $this->notazz = new Notazz;
    }

    public function test_notazz_is_nfe()
    {
        $this->notazz
            ->apiKey('123')
            ->destinatario()
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
            ->documento()
                ->nfe()
                ->basevalue(70.30)
                ->description('Venda')
                ->issueDate('2021-01-08 10:23:47')
            ->produtos()
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

        $this->assertFalse($this->notazz->isNFSe());
    }

    public function test_valida_dados_retornados_apos_montagem_da_nota()
    {
        $this->notazz->nfe()
            ->apiKey('123')
            ->destinatario()
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
            ->documento()
                ->basevalue(70.30)
                ->description('Venda')
                ->issueDate('2021-01-08 10:23:47')
            ->produtos()
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

        $resultado = $this->notazz->nfeToArray();

        $esperado = [
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
            'DOCUMENT_BASEVALUE'   => '70.3',
            'DOCUMENT_DESCRIPTION' => 'Venda',
            'DOCUMENT_ISSUE_DATE'  => '2021-01-08 10:23:47',
            'DOCUMENT_PRODUCT'     => [
                [
                    'DOCUMENT_PRODUCT_COD'           => '00654',
                    'DOCUMENT_PRODUCT_NAME'          => 'Escova de dentes Cepacol',
                    'DOCUMENT_PRODUCT_QTD'           => '2',
                    'DOCUMENT_PRODUCT_UNITARY_VALUE' => '15.2'
                ], [
                    'DOCUMENT_PRODUCT_COD'           => '00123',
                    'DOCUMENT_PRODUCT_NAME'          => 'Pano de prato para cozinha',
                    'DOCUMENT_PRODUCT_QTD'           => '1',
                    'DOCUMENT_PRODUCT_UNITARY_VALUE' => '55.1'
                ],
            ],
        ];

        $this->assertEqualsCanonicalizing($resultado, $esperado);
    }
}
