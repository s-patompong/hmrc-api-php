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

    public function __construct()
    {
        $this->client = new Client;
    }

    /**
     * @return HMRCResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fire()
    {
        /** @var Response $response */
        $response = $this->client->request($this->getMethod(), $this->getURI(), $this->getHTTPClientOptions());

        return new HMRCResponse($response);
    }

    /**
     * Get options to call via HTTP client
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
        return [
            RequestHeader::ACCEPT => $this->getAcceptHeader(),
        ];
    }

    protected function getURI(): string
    {
        return "{$this->getApiBaseUrl()}{$this->getApiPath()}";
    }

    protected function getApiBaseUrl(): string
    {
        if(Environment::getInstance()->isSandbox()) {
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
    public function setServiceVersion(string $serviceVersion): Request
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
    public function setContentType(string $contentType): Request
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @param Client $client
     *
     * @return Request
     */
    public function setClient(Client $client): Request
    {
        $this->client = $client;

        return $this;
    }

    abstract protected function getMethod(): string;
    abstract protected function getApiPath(): string;
}
