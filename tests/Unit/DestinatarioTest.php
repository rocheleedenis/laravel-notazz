<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use RocheleEdenis\LaravelNotazz\Builders\DestinationBuilder;
use RocheleEdenis\LaravelNotazz\Exceptions\RequiredFieldException;

class DestinationTest extends TestCase
{
    public function test_monta_document_corretamente()
    {
        $document = app(DestinationBuilder::class)
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

        $esperado = [
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
        ];

        $this->assertEqualsCanonicalizing(
            $esperado,
            $document->getInstance()->toArray()
        );
    }

    public function test_verifica_falta_de_campos_obrigatorios()
    {
        $this->expectException(RequiredFieldException::class);

        $document = app(DestinationBuilder::class)
            ->name('Marli Kamilly Daiane da Conceição')
            ->taxid('09889568020')
            ->taxtype('F')
            ->street('Rua dos Limões')
            ->number(735)
            ->district('Maria Goretti')
            ->city('Belo Horizonte')
            ->zipcode('31930-425')
            ->email('marlikamilly@teste.com')
            ->phone(3128334142);

        $document->getInstance()->checkRequiredFiels();
    }
}
