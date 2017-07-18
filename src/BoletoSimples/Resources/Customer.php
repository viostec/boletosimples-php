<?php

namespace BoletoSimples;

use GuzzleHttp\Psr7\Response;

class Customer extends BaseResource
{
    public static function cnpj_cpf($cnpj_cpf)
    {
        if (!$cnpj_cpf) {
            throw new \Exception("Couldn't find ".get_called_class()." without an cnpj or cpf.");
        }

        /** @var Response $response */
        $response = self::_sendRequest('GET', 'customers/cnpj_cpf', ['query' => ['q' => $cnpj_cpf]]);
        $body = $response->getBody()->getContents();
        $json = (array) json_decode($body);

        return new Customer($json);
    }

    public static function email($email)
    {
        if (!$email) {
            throw new \Exception("Couldn't find ".get_called_class()." without an email.");
        }

        /** @var Response $response */
        $response = self::_sendRequest('GET', 'customers/email', ['query' => ['q' => $email]]);
        $body = $response->getBody()->getContents();
        $json = (array) json_decode($body);

        return new Customer($json);
    }
}
