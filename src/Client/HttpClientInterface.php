<?php

namespace VerticalResponse\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function send(RequestInterface $request);
}
