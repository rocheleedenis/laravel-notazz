<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use RocheleEdenis\LaravelNotazz\Builders\DocumentoBuilder;
use RocheleEdenis\LaravelNotazz\Exceptions\RequiredFieldException;

class DocumentoTest extends TestCase
{
    public function test_monta_documento_corretamente()
    {
        $documento = app(DocumentoBuilder::class)
            ->basevalue(70.30)
            ->cnae(8599604)
            ->goal(1)
            ->operationType(1)
            ->referenced('510807012123440001275500010000000981364117781')
            ->natureOperation('VENDA')
            ->description('DOCUMENTO EMITIDO POR ME OU EPP OPTANTE PELO SIMPLES NACIONAL')
            ->issueDate('2021-01-08 10:23:47')
            ->attachment("https://app.notazz.com/contrato-de-licenca-notazz.pdf");

        $esperado = [
            'DOCUMENT_BASEVALUE'        => '70.30',
            'DOCUMENT_DESCRIPTION'      => 'DOCUMENTO EMITIDO POR ME OU EPP OPTANTE PELO SIMPLES NACIONAL',
            'DOCUMENT_CNAE'             => '8599604',
            'DOCUMENT_GOAL'             => '1',
            'DOCUMENT_OPERATION_TYPE'   => '1',
            'DOCUMENT_REFERENCED'       => '510807012123440001275500010000000981364117781',
            'DOCUMENT_NATURE_OPERATION' => 'VENDA',
            'DOCUMENT_ISSUE_DATE'       => '2021-01-08 10:23:47',
            "DOCUMENT_ATTACHMENT"       => "https://app.notazz.com/contrato-de-licenca-notazz.pdf",
        ];

        $this->assertEqualsCanonicalizing(
            $esperado,
            $documento->getInstance()->toArray()
        );
    }

    public function test_verifica_falta_de_campos_obrigatorios()
    {
        $this->expectException(RequiredFieldException::class);

        $documento = app(DocumentoBuilder::class)
            ->natureOperation('VENDA')
            ->cnae(8599604)
            ->goal(1);

        $documento->getInstance()->checkRequiredFiels();
    }
}
