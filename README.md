[![Packagist](https://img.shields.io/packagist/v/rocheleedenis/laravel-notazz.svg?style=flat-square)](https://github.com/rocheleedenis/laravel-boleto)
[![Packagist](https://img.shields.io/packagist/dt/rocheleedenis/laravel-notazz.svg?style=flat-square)](https://github.com/rocheleedenis/laravel-notazz)
[![Packagist](https://img.shields.io/packagist/l/rocheleedenis/laravel-notazz.svg?style=flat-square)](https://github.com/rocheleedenis/laravel-notazz)
[![GitHub forks](https://img.shields.io/github/forks/rocheleedenis/laravel-notazz.svg?style=social&label=Fork)](https://github.com/rocheleedenis/laravel-notazz)

# Laravel Notazz

Pacote para facilitar integração com o sistema de emissão de notas fiscais Notazz.

## Instalação

### Requerimentos

- [Php 7.2](http://php.net/releases/7_0_0.php)
- [Laravel 5.8](https://laravel.com/docs/5.8)

Instalação via linha de comando:

`$ composer require rocheleedenis/laravel-notazz`

## Modo de usar

Por enquanto só é possível gerar NF-e (Nota Fiscal de Produto).
Exemplo de como criar uma com os campos obrigatórios:

```php
$notaFiscal = app(NotaFiscalBuilder::class);
$notaFiscal
    ->nfe()
    ->apiKey('b5b8f576a8075442d75be165b0447ace')
    ->destination()
        ->name('Beatriz Isabelly Mendes')
        ->taxid('01708781390')
        ->taxtype('F')
        ->street('Rua João Soares Lima')
        ->number('S/N')
        ->district('Centro')
        ->city('Águas Belas')
        ->uf('CE')
        ->zipcode('63887-973')
        ->email('beatriz.isabelly@gmail.com')
        ->phone('(88) 2592-2647')
    ->document()
        ->basevalue(70.30)
        ->description('Venda')
    ->products()
        ->add()
            ->cod(123)
            ->name('Escova de dente Cepacol')
            ->qtd(2)
            ->unitaryValue(15.20)
        ->save()
        ->add()
            ->cod(124)
            ->name('Pano de prato para cozinha')
            ->qtd(1)
            ->unitaryValue(55.10)
        ->save();
```

Os métodos usados após usar os métodos principais `document()`, `destination()` e `products()` levam exatamente o mesmo nome das propriedades descritas na documentação oficial do Notazz, mas removendo o prefixo da entidade a quem pertece. Qualquer propriedade que não esteja presente no exemplo está disponível seguindo essa lógica.

### Testes

Por definição o retorno das funções que fazem chamada na API do Notazz retornam sempre mensagens de **sucesso**, personalizada de acordo com o método chamado, se o ambiente não for 'production'.

### Métodos disponíveis

Após instanciar a classe Notazz será possível chamar os seguintes métodos:

```php
$notaFiscal = new \RocheleEdenis\LaravelNotazz\Builders\NotaFiscalBuilder;

// Retorna a soma do valor dos itens da nota fiscal
$notaFiscal->sumItemsValue();

// Retorna o array com a nota ja montada
$notaFiscal->toArray()
```

Após instanciar a classe Notazz será possível chamar os seguintes métodos:

```php
$notazz = new \RocheleEdenis\LaravelNotazz;

// Envia a requisição para o Notazz para registrar a nova nota
$notaFiscal = new NotaFiscalBuilder;
...
$notazz->register($notaFiscal);
```

**Importante!**
Como já tivemos muitos problemas com envio de informações para o Notazz com tipos diferentes de dados, todas as propriedades serão convertidas para `string` antes do envio, não importa o tipo de dados recebido ao montar a nota!

## Documentação Oficial

Esta é uma API não oficial. Foi criada com base na [documentação](https://app.notazz.com/docs/api) disponibilizada pelo Notazz.

## Créditos

Este projeto foi baseado no [SDK PHP Notazz](https://github.com/leoqbc/sdk-php-notazz).

## Suporte

Para reportar qualquer bug ou deixar sugestões, por favor, abra uma nova issue no github.

## Licença

Distribuido sobre a licença MIT. Copie, cole, modifique, melhore e compartilhe!
