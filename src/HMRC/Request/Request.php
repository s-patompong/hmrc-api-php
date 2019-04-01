<?php

namespace HMRC\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use HMRC\Environment\Environment;
use HMRC\Response\Response as HMRCResponse;

abstract class Request
{
    /** @var Client Guzzle client */
    protected $client;

    /** @var string Service version of HMRC API */
    protected $serviceVersion = '1.0';

    /** @var string Content type of the request */
    protected $contentType = 'json';

    /**
     * Array of additional headers to add in each request.
     *
     * @var array
     */
    protected $headers = [];

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return HMRCResponse
     */
    public function fire()
    {
        /** @var Response $response */
        $response = $this->client->request($this->getMethod(), $this->getURI(), $this->getHTTPClientOptions());

        return new HMRCResponse($response);
    }

    /**
     * Get options to call via HTTP client.
     *
     * @return array
     */
    protected function getHTTPClientOptions(): array
    {
        return [
            'headers' => $this->getHeaders(),
        ];
    }

    protected function getAcceptHeader(): string
    {
        return "application/vnd.hmrc.{$this->serviceVersion}+{$this->contentType}";
    }

    protected function getAuthorizationHeader(string $token): string
    {
        return "Bearer {$token}";
    }

    protected function getHeaders(): array
    {
        return array_merge(
            // headers set in environment
            Environment::getInstance()->getDefaultRequestHeaders(),
            // headers set for this request
            $this->headers,
            // and more
            [
                RequestHeader::ACCEPT => $this->getAcceptHeader(),
            ]
        );
    }

    protected function getURI(): string
    {
        return "{$this->getApiBaseUrl()}{$this->getApiPath()}";
    }

    protected function getApiBaseUrl(): string
    {
        if (Environment::getInstance()->isSandbox()) {
            return RequestURL::SANDBOX;
        }

        return RequestURL::LIVE;
    }

    /**
     * @return string
     */
    public function getServiceVersion(): string
    {
        return $this->serviceVersion;
    }

    /**
     * @param string $serviceVersion
     *
     * @return Request
     */
    public function setServiceVersion(string $serviceVersion): self
    {
        $this->serviceVersion = $serviceVersion;

        return $this;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     *
     * @return Request
     */
    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @param Client $client
     *
     * @return Request
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Adds additional header or array of headers.
     *
     * @param string|array $key
     * @param string       $value
     */
    public function addHeader($key, $value = null)
    {
        $this->headers = array_merge($this->headers, is_array($key) ? $key : [$key => $value]);
    }

    abstract protected function getMethod(): string;

    abstract protected function getApiPath(): string;
}
