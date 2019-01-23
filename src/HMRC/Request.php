<?php


namespace HMRC;


use GuzzleHttp\Client;

abstract class Request
{
    /** @var string URL of sandbox environment */
    const URL_SANDBOX = 'https://test-api.service.hmrc.gov.uk';

    /** @var string URL of live environment */
    const URL_LIVE = 'https://api.service.hmrc.gov.uk';

    /** @var string constant for method GET */
    const METHOD_GET = 'GET';

    /** @var string constant for method POST */
    const METHOD_POST = 'POST';

    /** @var Client Guzzle client */
    protected $client;

    /** @var string API base URL */
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->client = new Client;
        $this->apiBaseUrl = static::URL_SANDBOX;
    }

    public function useLiveEnv()
    {
        $this->apiBaseUrl = static::URL_LIVE;

        return $this;
    }

    public function useSandboxEnv()
    {
        $this->apiBaseUrl = static::URL_SANDBOX;

        return $this;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fire()
    {
        return $this->client->request($this->getMethod(), "{$this->apiBaseUrl}{$this->getApiPath()}", [
            'headers' => [
                'Accept' => 'application/vnd.hmrc.1.0+json',
            ],
        ]);
    }

    abstract function getMethod();
    abstract function getApiPath();
}
