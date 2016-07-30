<?php

namespace VerticalResponse\Client;

use Psr\Http\Message\RequestInterface;

interface RequestProviderInterface
{
    /**
     * @param string      $method
     * @param string      $uri
     * @param array       $headers
     * @param string|null $body
     * @param string      $version
     * @return RequestInterface
     */
    public function createRequest(
        $method,
        $uri,
        array $headers = [],
        $body = null,
        $version = '1.1'
    );
}
