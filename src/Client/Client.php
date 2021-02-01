<?php

namespace RocheleEdenis\LaravelNotazz\Client;

class Client
{
    protected const API_URL = 'https://app.notazz.com/api';

    const STATUS_SUCESSO = 'sucesso';
    const STATUS_ERRO    = 'erro';

    const COD_SUCESSO                 = '000';
    const COD_REQUISICAO_SIMULTANEA   = '120';
    const COD_API_EM_MANUTENCAO       = '999';
    const COD_APIKEY_NAO_LIBERADA     = '305';
    const COD_APIKEY_INVALIDA         = '303';
    const COD_REGISTRO_NAO_ENCONTRADO = '202';

    public function request(array $fields)
    {
        if (config('app.env') != 'production') {
            return $this->mockResponse();
        }

        return $this->sendRequest($fields);
    }

    private function mockResponse()
    {
        return [
            'id'                  => md5(now()),
            'statusProcessamento' => self::STATUS_SUCESSO,
            'codigoProcessamento' => self::COD_SUCESSO,
        ];
    }

    private function sendRequest($fields)
    {
        try {
            header('Content-type: text/html; charset=utf-8');

            $fields = ['fields' => json_encode($fields)];

            $fields_string = '';

            //url-ify the data for the POST
            foreach ($fields as $key => $value) {
                $fields_string .= $key . '=' . $value . '&';
            }

            rtrim($fields_string, '&');
            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, self::API_URL);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            //execute post
            $response = curl_exec($ch);

            //close connection
            curl_close($ch);

            //Convertendo json para array
            $pos = strpos($response, '{');

            return (json_decode(substr($response, $pos), true));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
