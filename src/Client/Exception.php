<?php

namespace VerticalResponse\Client;

use Psr\Http\Message\ResponseInterface;

class Exception extends \Exception
{
    /** @var ResponseInterface */
    private $response = null;

    /**
     * Exception constructor.
     * @param string            $message
     * @param ResponseInterface $response
     * @param int               $code
     * @param Exception|null    $previous
     */
    public function __construct($message, ResponseInterface $response, $code = 0, Exception $previous = null)
    {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
