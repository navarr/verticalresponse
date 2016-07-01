<?php

namespace VerticalResponse;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use VerticalResponse\Client\Exception;
use VerticalResponse\Client\HttpClient;
use VerticalResponse\Client\HttpException;
use VerticalResponse\Client\RequestProvider;

class Client
{
    const LOCATION = 'https://vrapi.verticalresponse.com/api/v1/';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var RequestProvider
     */
    private $requestProvider;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * Client constructor.
     * @param string               $accessToken
     * @param HttpClient|null      $client
     * @param RequestProvider|null $requestProvider
     */
    public function __construct($accessToken, HttpClient $client = null, RequestProvider $requestProvider = null)
    {
        $this->accessToken = $accessToken;
        if (!$client && !class_exists('VerticalResponse\Client\GuzzleClient')) {
            throw new \InvalidArgumentException('An HttpClient is required, or verticalresponse-guzzle installed');
        }
        if (!$requestProvider && !class_exists('VerticalResponse\Client\GuzzleRequestFactory')) {
            throw new \InvalidArgumentException('A RequestProvider is required, or verticalresponse-guzzle installed');
        }
        $this->requestProvider = $requestProvider ?: new \VerticalResponse\Client\GuzzleRequestFactory();
        $this->client = $client ?: new \VerticalResponse\Client\GuzzleClient(['base_uri' => static::LOCATION]);
    }

    /**
     * @param string $url
     * @param array  $parameters
     * @return \stdClass
     * @throws Exception
     * @throws HttpException
     */
    public function get($url, $parameters = [])
    {
        $query = $this->buildQuery($url, $parameters);
        $url = static::LOCATION.$url.(strpos($url, '?') !== false ? '&' : '?').$query;
        $headers = $this->buildHeaders();

        $request = $this->requestProvider->createRequest('GET', $url, $headers);
        $response = $this->client->send($request);

        // Throw any errors we have before continuing
        $this->errorCheckResponse($response);

        return json_decode($this->streamToString($response->getBody()));
    }

    /**
     * @param string $url
     * @param array  $parameters
     * @return \stdClass
     * @throws Exception
     * @throws HttpException
     */
    public function post($url, $parameters = [])
    {
        $url = static::LOCATION.$url;
        $headers = $this->buildHeaders();

        $request = $this->requestProvider->createRequest('POST', $url, $headers, json_encode($parameters));
        $response = $this->client->send($request);

        $this->errorCheckResponse($response);

        return json_decode($this->streamToString($response->getBody()));
    }

    /**
     * @param string $url
     * @param array  $parameters
     * @return string
     */
    protected function buildQuery($url, $parameters)
    {
        return http_build_query($parameters);
    }

    /**
     * @return string[]
     */
    protected function buildHeaders()
    {
        return [
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => "Bearer {$this->accessToken}",
        ];
    }

    /**
     * @param ResponseInterface $response
     * @return void
     * @throws Exception
     * @throws HttpException
     */
    protected function errorCheckResponse(ResponseInterface $response)
    {
        $body = $response->getBody();

        if ($response->getStatusCode() >= 400) {
            throw new HttpException($response);
        }

        $responseObject = json_decode($this->streamToString($body));
        if (!isset($json)) {
            throw new Exception('JSON returned is not valid', $response);
        }

        if (isset($responseObject->error)) {
            throw new Exception($responseObject->error, $response);
        }
    }

    /**
     * @param StreamInterface $stream
     * @return string
     */
    protected function streamToString(StreamInterface $stream)
    {
        $stream->rewind();
        return $stream->getContents();
    }

    /** @return string */
    public function getLocation()
    {
        return static::LOCATION;
    }
}
