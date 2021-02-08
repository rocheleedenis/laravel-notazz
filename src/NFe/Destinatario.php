<?php

namespace RocheleEdenis\LaravelNotazz\NFe;

use \Illuminate\Support\Str;
use Illuminate\Support\Collection;

class Destinatario
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
     * Set the value of DESTINATION_NAME
     * Nome completo do cliente
     *
     * @param string $destination_name
     */
    public function setDestinationName(string $destination_name)
    {
        $this->collection->put('destination_name', $destination_name);
    }

    /**
     * Set the value of DESTINATION_TAXID
     * CPF ou CNPJ
     *
     * @param int $destination_taxid
     */
    public function setDestinationTaxid(string $destination_taxid)
    {
        $this->collection->put('destination_taxid', $destination_taxid);
    }

    /**
     * Set the value of DESTINATION_IE
     * Inscrição Estadual
     *
     * @param string $destination_ie
     */
    public function setDestinationIe(string $destination_ie)
    {
        $this->collection->put('destination_ie', $destination_ie);
    }

    /**
     * Set the value of DESTINATION_IM
     * Inscrição Municipal
     *
     * @param string $destination_im
     */
    public function setDestinationIm(string $destination_im)
    {
        $this->collection->put('destination_im', $destination_im);
    }

    /**
     * Set the value of DESTINATION_TAXTYPE
     * F = Física, J = Jurídica, E = Estrangeiro
     *
     * @param string $destination_taxtype
     */
    public function setDestinationTaxtype(string $destination_taxtype)
    {
        $valoresAceitos = ['F', 'J', 'E'];
        $destination_taxtype = Str::upper($destination_taxtype);

        if (! in_array($destination_taxtype, $valoresAceitos)) {
            throw new \Exception("O tipo do destinatário (taxtype) precisa ser um dos seguintes valores: 'F', 'J' ou 'E'", 1);
        }

        $this->collection->put('destination_taxtype', $destination_taxtype);
    }

    /**
     * Set the value of DESTINATION_STREET
     * Logradouro
     *
     * @param string $destination_street
     */
    public function setDestinationStreet(string $destination_street)
    {
        $this->collection->put('destination_street', $destination_street);
    }

    /**
     * Set the value of DESTINATION_NUMBER
     * Número
     *
     * @param string $destination_number
     */
    public function setDestinationNumber(string $destination_number)
    {
        $this->collection->put('destination_number', $destination_number);
    }

    /**
     * Set the value of DESTINATION_COMPLEMENT
     * Complemento
     *
     * @param string $destination_complement
     */
    public function setDestinationComplement($destination_complement = '')
    {
        $this->collection->put('destination_complement', $destination_complement);
    }

    /**
     * Set the value of DESTINATION_DISTRICT
     * Bairro
     *
     * @param string $destination_district
     */
    public function setDestinationDistrict(string $destination_district)
    {
        $this->collection->put('destination_district', $destination_district);
    }

    /**
     * Set the value of DESTINATION_CITY
     * Cidade
     *
     * @param string $destination_city
     */
    public function setDestinationCity(string $destination_city)
    {
        $this->collection->put('destination_city', $destination_city);
    }

    /**
     * Set the value of DESTINATION_UF
     * Estado
     *
     * @param int $destination_uf
     */
    public function setDestinationUf(string $destination_uf)
    {
        $estadosBrasileiros = ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];

        if (!in_array($destination_uf, $estadosBrasileiros)) {
            throw new \Exception('Estado do destinatário (UF) não existe!', 1);
        }

        $this->collection->put('destination_uf', $destination_uf);
    }

    /**
     * Set the value of DESTINATION_ZIPCODE
     * CEP
     *
     * @param string $destination_zipcode
     */
    public function setDestinationZipcode(string $destination_zipcode)
    {
        $this->collection->put('destination_zipcode', $destination_zipcode);
    }

    /**
     * Set the value of DESTINATION_PHONE
     * Telefone
     *
     * @param string $destination_phone
     */
    public function setDestinationPhone(string $destination_phone = '')
    {
        $this->collection->put('destination_phone', $destination_phone);
    }

    /**
     * Set the value of DESTINATION_EMAIL
     * E-mail
     *
     * @param string $destination_email
     */
    public function setDestinationEmail(string $destination_email)
    {
        $this->collection->put('destination_email', $destination_email);
    }

    /**
     * Set the value of DESTINATION_EMAIL_SEND
     * Esse parâmetro é um Array que irá conter os e-mails que será enviado após a nota ser autorizada ou cancelada.
     * OBS: Para cada e-mail que será enviado, passe os parâmetros abaixo alterando o índice em +1 para cada e-mail
     *
     * @param array $destination_email_send
     */
    public function setDestinationEmailSend(array $destination_email_send)
    {
        $this->collection->put('destination_email_send', $destination_email_send);
    }

    public function mount()
    {
        return $this->collection->mapWithKeys(function($value, $key) {
            return [Str::upper($key) => $value];
        })->toArray();
    }
}
