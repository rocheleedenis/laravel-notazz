<?php

namespace RocheleEdenis\LaravelNotazz;

use GuzzleHttp\Client;
use RocheleEdenis\LaravelNotazz\Builders\NotaFiscalBuilder;
use RocheleEdenis\LaravelNotazz\Exceptions\ErrorStatusProcessamentoException;

class Notazz
{
    public const API_URL = 'https://app.notazz.com/api';

    /**
     * Status possíveis
     */
    const STATUS_SUCESSO = 'sucesso';
    const STATUS_ERRO    = 'erro';

    /**
     * Códigos de resposta da API
     */
    const COD_SUCESSO                 = 000;
    const COD_REQUISICAO_SIMULTANEA   = 120;
    const COD_MANUTENCAO              = 999;
    const COD_APIKEY_NAO_LIBERADA     = 305;
    const COD_APIKEY_INVALIDA         = 303;
    const COD_REGISTRO_NAO_ENCONTRADO = 202;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var NotaFiscalBuilder
     */
    protected $nota;

    /**
     * @param string
     * @param mixed
     */
    public function __construct()
    {
        $this->client = app(Client::class);
    }

    public function registrarNota(NotaFiscalBuilder $nota)
    {
        $this->nota = $nota;

        return $this->sendRequest($this->prepareRequest());
    }

    protected function prepareRequest()
    {
        // verifica se falta informação pra mandar
        return $this->nota->toArray();
    }

    protected function sendRequest(array $fields)
    {
        try {
            $response = $this->client->request('POST', self::API_URL, [
                'form_params' => [
                    "fields" => json_encode($fields)
                ],
                false
            ]);

            $result = json_decode($response->getBody()->getContents());

            if ($result->statusProcessamento === 'erro') {
                throw new ErrorStatusProcessamentoException("Erro ao registrar a nota: $result->motivo", 400);
            }

            return $result;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
