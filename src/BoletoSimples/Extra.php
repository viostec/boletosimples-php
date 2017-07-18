<?php

namespace BoletoSimples;

use GuzzleHttp\Psr7\Response;

class Extra
{
    public static function userinfo()
    {
        /** @var Response $response */
        $response = BaseResource::sendRequest('GET', 'userinfo');
        $body = $response->getBody()->getContents();
        $json = (array) json_decode($body);

        return $json;
    }
}