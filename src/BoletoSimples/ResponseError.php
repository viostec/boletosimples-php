<?php

namespace BoletoSimples;

class ResponseError extends \Exception {
    /**
     * @var Response
     */
    public $response = null;

    /**
     * Constructor method.
     */
    public function __construct($response) {
        $this->response = $response;

        $body = $this->response->getBody()->getContents();
        $json = json_decode($body);

        if (isset($json->errors)) {
            $this->message = $json->errors;
            throw $this;
        }
    }
}