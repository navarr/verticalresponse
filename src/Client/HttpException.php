<?php

namespace VerticalResponse\Client;

use Psr\Http\Message\ResponseInterface;

class HttpException extends Exception
{
    /**
     * HttpException constructor.
     * @param ResponseInterface $response
     * @param Exception|null    $previous
     */
    public function __construct(ResponseInterface $response, Exception $previous = null)
    {
        $message = 'HTTP Error communicating with API: '.$response->getStatusCode();
        parent::__construct($message, $response, $response->getStatusCode(), $previous);
    }
}
