<?php

namespace BoletoSimples;

use GuzzleHttp\Psr7\Response;

class ResponseError extends \Exception {
    /**
     * @var Response
     */
    public $response = null;

    /**
     * @var array
     */
    public $errors = [];

    /**
     * Constructor method.
     */
    public function __construct(Response $response) {
        $this->response = $response;

        $body = $this->response->getBody()->getContents();
        $json = json_decode($body);

        if (isset($json->errors)) {
            $this->errors = (array)$json->errors;
        }

        parent::__construct("Erro na requisição ao servidor", $response->getStatusCode());
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
