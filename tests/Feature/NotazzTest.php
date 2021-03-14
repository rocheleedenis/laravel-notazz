<?php

namespace RocheleEdenis\LaravelNotazz\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use RocheleEdenis\LaravelNotazz\Builders\NotaFiscalBuilder;
use RocheleEdenis\LaravelNotazz\Exceptions\RequiredFieldException;
use RocheleEdenis\LaravelNotazz\Notazz;

class NotazzTest extends TestCase
{
    public function test_registra_nota_fiscal_no_notazz()
    {
        $esperado = [
            'id'                  => md5('id_da_nota_criada'),
            'codigoProcessamento' => '000',
            'statusProcessamento' => 'sucesso',
        ];

        $this->mockRespostaNotazz($esperado);

        $notaFiscal = app(NotaFiscalBuilder::class)->nfe()
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

        $response = app(Notazz::class)->registrarNota($notaFiscal);

        $esperado = (object) $esperado;

        $this->assertEquals($esperado, $response);
    }

    public function test_nao_registra_nota_faltando_campos()
    {
        $this->expectException(RequiredFieldException::class);

        $this->mockRespostaNotazz();

        $notaFiscal = app(NotaFiscalBuilder::class)->nfe()
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
                ->basevalue(70.30)
                ->description('Venda')
                ->issueDate('2021-01-08 10:23:47');

        app(Notazz::class)->registrarNota($notaFiscal);
    }

    protected function mockRespostaNotazz(array $res = [])
    {
        $stream = $this->createMock(Stream::class);
        $stream->method('getContents')
            ->willReturn(json_encode($res));

        $response = $this->createMock(Response::class);
        $response->method('getBody')
            ->willReturn($stream);

        $client = $this->createMock(Client::class);
        $client->method('request')
            ->willReturn($response);
        app()->instance(Client::class, $client);
    }
}
