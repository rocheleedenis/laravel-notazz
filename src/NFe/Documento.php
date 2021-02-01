<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

use Illuminate\Support\Str;

class Documento
{
    /**
     * Collection object.
     *
     * @var Collection
     */
    protected $collection;

    public function __construct()
    {
        $this->collection = collect();
    }

    /**
     * Set the value of DOCUMENT_BASEVALUE
     * Valor da nota fiscal
     *
     * @param float $document_basevalue
     */
    public function setDocumentBasevalue(float $document_basevalue)
    {
        $this->collection->put('document_basevalue', (string) $document_basevalue);
    }

    /**
     * Set the value of DOCUMENT_CNAE
     * CNAE. Documentação: http://www.cnae.ibge.gov.br
     *
     * @param int $document_cnae
     *
     * @return self
     */
    public function setDocumentCnae(int $document_cnae)
    {
        $this->collection->put('document_cnae', (string) $document_cnae);

        return $this;
    }

    /**
     * Set the value of DOCUMENT_GOAL
     * Finalidade da Nota Fiscal. 1 = Normal, 2 = Complementar, 3 = Ajuste, 4 = Devolução/Retorno
     *
     * @param int $document_goal
     */
    public function setDocumentGoal(int $document_goal)
    {
        $goals = [1, 2, 3, 4];

        if (!in_array($document_goal, $goals)) {
            throw new Exception('Finalidade (goal) da nota fiscal não definida!', 1);
        }

        $this->collection->put('document_goal', (string) $document_goal);
    }

    /**
     * Set the value of DOCUMENT_REFERENCED
     * Chave da nota fiscal referenciada. Utilizar quando DOCUMENT_GOAL for diferente de 1
     *
     * @param string $document_referenced
     */
    public function setDocumentReferenced(string $document_referenced)
    {
        $this->collection->put('document_referenced', $document_referenced);
    }

    /**
     * Set the value of DOCUMENT_OPERATION_TYPE
     * Tipo de Operação. 0 = Entrada, 1 = Saída
     *
     * @param int $document_operation_type
     */
    public function setDocumentOperationType(int $document_operation_type)
    {
        $tiposOperacao = [0, 1];

        if (!in_array($document_operation_type, $tiposOperacao)) {
            throw new Exception('Tipo de operação (operationType) da nota fiscal não definida!', 1);
        }

        $this->collection->put('document_operation_type', (string) $document_operation_type);
    }

    /**
     * Set the value of DOCUMENT_NATURE_OPERATION
     * Natureza da operação da nota fiscal
     *
     * @param string $document_nature_operation
     */
    public function setDocumentNatureOperation(string $document_nature_operation)
    {
        $this->collection->put('document_nature_operation', (string) $document_nature_operation);
    }

    /**
     * Set the value of DOCUMENT_DESCRIPTION
     * Descrição da nota fiscal
     *
     * @param string $document_description
     */
    public function setDocumentDescription(string $document_description)
    {
        $this->collection->put('document_description', (string) $document_description);
    }

    /**
     * Data de emissão automática da nota fiscal (por padrão é a data atual) formato YYYY-mm-dd HH:ii:ss
     *
     * @param string $document_issue_date
     */
    public function setDocumentIssueDate(string $document_issue_date)
    {
        $this->collection->put('document_issue_date', (string) $document_issue_date);
    }

    public function mount()
    {
        return $this->collection->mapWithKeys(function($value, $key) {
            return [Str::upper($key) => $value];
        })->toArray();
    }
}
