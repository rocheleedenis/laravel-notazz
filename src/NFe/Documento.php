<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

use Illuminate\Support\Str;
use RocheleEdenis\LaravelNotazz\Exceptions\RequiredFieldException;

class Documento
{
    const REQUIRED_PROPERTIES = [
        'document_basevalue',
    ];

    /**
     * * Associative collection for storing property values.
     *
     * @var Collection
     */
    protected $content;

    public function __construct()
    {
        $this->content = collect();
    }

    /**
     * Set the value of DOCUMENT_BASEVALUE
     * Valor da nota fiscal
     *
     * @param float $value
     */
    public function setDocumentBasevalue(float $value)
    {
        $value = number_format($value, 2, '.', '');

        $this->content->put('document_basevalue', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_CNAE
     * CNAE. Documentação: http://www.cnae.ibge.gov.br
     *
     * @param int $value
     *
     * @return self
     */
    public function setDocumentCnae(int $value)
    {
        $this->content->put('document_cnae', (string) $value);

        return $this;
    }

    /**
     * Set the value of DOCUMENT_GOAL
     * Finalidade da Nota Fiscal. 1 = Normal, 2 = Complementar, 3 = Ajuste, 4 = Devolução/Retorno
     *
     * @param int $value
     */
    public function setDocumentGoal(int $value)
    {
        $goals = [1, 2, 3, 4];

        if (!in_array($value, $goals)) {
            throw new Exception('Finalidade (goal) da nota fiscal não definida!', 1);
        }

        $this->content->put('document_goal', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_REFERENCED
     * Chave da nota fiscal referenciada. Utilizar quando DOCUMENT_GOAL for diferente de 1
     *
     * @param string $value
     */
    public function setDocumentReferenced(string $value)
    {
        $this->content->put('document_referenced', $value);
    }

    /**
     * Set the value of DOCUMENT_OPERATION_TYPE
     * Tipo de Operação. 0 = Entrada, 1 = Saída
     *
     * @param int $value
     */
    public function setDocumentOperationType(int $value)
    {
        $tiposOperacao = [0, 1];

        if (!in_array($value, $tiposOperacao)) {
            throw new Exception('Tipo de operação (operationType) da nota fiscal não definida!');
        }

        $this->content->put('document_operation_type', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_NATURE_OPERATION
     * Natureza da operação da nota fiscal
     *
     * @param string $value
     */
    public function setDocumentNatureOperation(string $value)
    {
        $this->content->put('document_nature_operation', (string) $value);
    }

    /**
     * Set the value of DOCUMENT_DESCRIPTION
     * Descrição da nota fiscal
     *
     * @param string $value
     */
    public function setDocumentDescription(string $value)
    {
        $this->content->put('document_description', (string) $value);
    }

    /**
     * Data de emissão automática da nota fiscal (por padrão é a data atual) formato YYYY-mm-dd HH:ii:ss
     *
     * @param string $value
     */
    public function setDocumentIssueDate(string $value)
    {
        $this->content->put('document_issue_date', (string) $value);
    }

    /**
     * Data de emissão automática da nota fiscal (por padrão é a data atual) formato YYYY-mm-dd HH:ii:ss
     *
     * @param string $value
     */
    public function setDocumentAttachment(string $value)
    {
        $this->content->put('document_attachment', (string) $value);
    }

    public function toArray()
    {
        return $this->content->mapWithKeys(function($value, $key) {
            return [Str::upper($key) => $value];
        })->toArray();
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
